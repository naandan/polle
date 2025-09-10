<?php

namespace App\Console\Commands;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml untuk halaman statis';

    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create('/privacy')->setPriority(0.5)->setChangeFrequency('monthly'))
            ->add(Url::create('/terms')->setPriority(0.5)->setChangeFrequency('monthly'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap berhasil dibuat di public/sitemap.xml');
    }
}
