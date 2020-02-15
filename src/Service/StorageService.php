<?php


namespace App\Service;


use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StorageService
{
    /**
     * @var string
     */
    private $bucket;

    /**
     * @var S3Client
     */
    private $client;

    /**
     * StorageService constructor.
     * @param string $bucket
     * @param string $region
     * @param string $key
     * @param string $secret
     */
    public function __construct(string $bucket, string $region, string $key, string $secret)
    {
        $this->bucket = $bucket;

        $this->client = new S3Client([
            'profil' => 'default',
            'version' => 'latest',
            'region' => $region,
            'credentials' => [
                'key' => $key,
                'secret' => $secret
            ]
        ]);
    }

    /**
     * @param string $filename
     * @param string $content
     * @return string
     */
    public function upload(string $filename, string $content): string {
        return $this->client->upload(
            $this->bucket,
            $filename,
            $content,
            'public-read'
        )->toArray()['ObjectURL'];
    }

    public function uploadFile(string $filename, File $file) {
        return $this->upload($filename, file_get_contents($file->getRealPath()));
    }
}