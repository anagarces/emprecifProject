<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Guía Completa del BORME: Cómo Consultar e Interpretar los Datos',
                'slug' => 'guia-completa-borme',
                'excerpt' => 'Aprende todo lo que necesitas saber sobre el BORME: qué es, cómo consultarlo y cómo interpretar la información que contiene para tomar decisiones empresariales informadas.',
                'content' => '<p>El Boletín Oficial del Registro Mercantil (BORME) es una herramienta fundamental para cualquier persona que necesite información fiable sobre empresas españolas. En esta guía completa, te explicamos desde los conceptos básicos hasta los detalles más avanzados para que puedas aprovechar al máximo esta valiosa fuente de información.</p>\n\n<h2>¿Qué es el BORME?</h2>\n<p>El BORME es el medio oficial de publicidad de los actos inscribibles de los sujetos inscriptos en el Registro Mercantil. Se publica diariamente y contiene información sobre altas, bajas y modificaciones de empresas, así como otros actos inscribibles.</p>\n\n<h2>Cómo consultar el BORME</h2>\n<p>Existen varias formas de consultar el BORME:</p>\n<ul>\n    <li>Acceso gratuito a través de la web del BORME</li>\n    <li>Servicios de pago con funcionalidades avanzadas</li>\n    <li>APIs para integración con otros sistemas</li>\n</ul>\n\n<h2>Interpretación de los datos</h2>\n<p>Entender la información del BORME puede ser complejo. Te explicamos cómo interpretar los datos más importantes y qué significan para el análisis empresarial.</p>',
                'category' => 'BORME',
                'tags' => ['borme', 'registro mercantil', 'empresas'],
                'published' => true,
                'published_at' => now(),
                'meta_title' => 'Guía Completa del BORME | Cómo Consultar e Interpretar los Datos',
                'meta_description' => 'Aprende todo sobre el BORME: qué es, cómo consultarlo e interpretar la información para tomar decisiones empresariales informadas.',
            ],
            [
                'title' => 'Análisis Financiero para Principiantes: Conceptos Básicos',
                'slug' => 'analisis-financiero-principiantes',
                'excerpt' => 'Descubre los conceptos básicos del análisis financiero y cómo aplicarlos para evaluar la salud financiera de cualquier empresa.',
                'content' => '<p>El análisis financiero es una herramienta esencial para evaluar la situación económica de una empresa. En este artículo, te explicamos los conceptos básicos para que puedas comenzar a analizar estados financieros como un profesional.</p>\n\n<h2>Estados financieros clave</h2>\n<p>Los principales estados financieros que debes conocer son:</p>\n<ul>\n    <li>Balance de situación</li>\n    <li>Cuenta de resultados</li>\n    <li>Estado de flujos de efectivo</li>\n</ul>\n\n<h2>Ratios financieros fundamentales</h2>\n<p>Los ratios financieros te permiten analizar diferentes aspectos de una empresa:</p>\n<ul>\n    <li>Liquidez</li>\n    <li>Endeudamiento</li>\n    <li>Rentabilidad</li>\n    <li>Eficiencia operativa</li>\n</ul>',
                'category' => 'Análisis Financiero',
                'tags' => ['análisis financiero', 'finanzas', 'empresas'],
                'published' => true,
                'published_at' => now()->subDays(2),
                'meta_title' => 'Análisis Financiero para Principiantes | Conceptos Básicos',
                'meta_description' => 'Aprende los conceptos básicos del análisis financiero y cómo aplicarlos para evaluar la salud financiera de cualquier empresa.',
            ],
            [
                'title' => 'Due Diligence: Guía Completa para la Evaluación de Empresas',
                'slug' => 'due-diligence-guia-completa',
                'excerpt' => 'Todo lo que necesitas saber sobre el proceso de due diligence en la evaluación de empresas, desde los aspectos legales hasta los financieros.',
                'content' => '<p>El due diligence es un proceso fundamental en operaciones de fusión y adquisición de empresas, inversiones o cualquier transacción empresarial importante. En esta guía, te explicamos en qué consiste y cómo llevarlo a cabo de manera efectiva.</p>\n\n<h2>Tipos de due diligence</h2>\n<p>Existen varios tipos de due diligence que puedes realizar según tus necesidades:</p>\n<ul>\n    <li>Due diligence legal</li>\n    <li>Due diligence financiero</li>\n    <li>Due diligence fiscal</li>\n    <li>Due diligence operativo</li>\n    <li>Due diligence tecnológico</li>\n</ul>\n\n<h2>Fases del proceso</h2>\n<p>El proceso de due diligence generalmente incluye las siguientes fases:</p>\n<ol>\n    <li>Planificación y alcance</li>\n    <li>Recopilación de información</li>\n    <li>Análisis y evaluación</li>\n    <li>Elaboración de informes</li>\n    <li>Presentación de hallazgos</li>\n</ol>',
                'category' => 'Due Diligence',
                'tags' => ['due diligence', 'evaluación', 'empresas', 'inversiones'],
                'published' => true,
                'published_at' => now()->subDays(5),
                'meta_title' => 'Due Diligence: Guía Completa para la Evaluación de Empresas',
                'meta_description' => 'Todo lo que necesitas saber sobre el proceso de due diligence en la evaluación de empresas, desde los aspectos legales hasta los financieros.',
            ],
        ];

        foreach ($posts as $post) {
            // Asegurarse de que las etiquetas sean un array
            if (isset($post['tags']) && is_string($post['tags'])) {
                $post['tags'] = explode(',', $post['tags']);
            }
            
            // Crear el post
            BlogPost::create($post);
        }
    }
}
