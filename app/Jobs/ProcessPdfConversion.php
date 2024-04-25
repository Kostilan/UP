<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\PdfToImage\Pdf;

class ProcessPdfConversion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pdfFilePath;

    /**
     * Create a new job instance.
     *
     * @param  string  $pdfFilePath
     * @return void
     */
    public function __construct($pdfFilePath)
    {
        $this->pdfFilePath = $pdfFilePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Создаем экземпляр Pdf и указываем путь к PDF-файлу
        $pdf = new Pdf($this->pdfFilePath);

        // Указываем путь для сохранения изображений
        $imagePath = storage_path('app/public/images/');

        // Получаем количество страниц в PDF-файле
        $numPages = $pdf->getNumberOfPages();

        // Проходим по каждой странице и конвертируем ее в изображение
        for ($pageNumber = 1; $pageNumber <= $numPages; $pageNumber++) {
            // Создаем экземпляр Pdf для каждой страницы
            $pdfPage = new Pdf($this->pdfFilePath, $pageNumber);

            // Указываем имя файла для сохранения изображения
            $imageFilename = 'page_' . $pageNumber . '.jpg';

            // Путь к изображению
            $imageFilePath = $imagePath . $imageFilename;

            // Конвертируем текущую страницу в изображение
            $pdfPage->saveImage($imageFilePath);
        }
    }
}