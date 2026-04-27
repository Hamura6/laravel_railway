<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera el sitemap del sitio ICAP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('weekly'))
            ->add(Url::create('/acerca-de')->setPriority(0.9)->setChangeFrequency('monthly'))
            ->add(Url::create('/cursos')->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create('/contacto')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/eventos')->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create('/noticias')->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create('/directorio')->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create('/convenios')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/privacidad')->setPriority(0.5)->setChangeFrequency('yearly'))
            ->add(Url::create('/requisitos')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/loginICAP')->setPriority(0.6)->setChangeFrequency('yearly'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generado correctamente');
    }
}
