const fs = require('fs');
const path = require('path');
const sharp = require('sharp');
const imagemin = require('imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminPngquant = require('imagemin-pngquant');
const imageminWebp = require('imagemin-webp');

// Directorios
const inputDir = path.join(__dirname, '../maquetacion_emprecif/images');
const outputDir = path.join(__dirname, '../public/images/optimized');

// Asegurarse de que el directorio de salida existe
if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
}

// Función para optimizar una imagen
async function optimizeImage(filePath) {
    try {
        const fileName = path.basename(filePath);
        const ext = path.extname(fileName).toLowerCase();
        const nameWithoutExt = path.basename(fileName, ext);
        
        console.log(`Procesando: ${fileName}`);
        
        // Optimizar con sharp
        const image = sharp(filePath);
        
        // Redimensionar si es muy grande (máximo 2000px de ancho)
        const metadata = await image.metadata();
        if (metadata.width > 2000) {
            image.resize(2000);
        }
        
        // Guardar en formato WebP
        await image
            .webp({ quality: 80 })
            .toFile(path.join(outputDir, `${nameWithoutExt}.webp`));
        
        // Si es PNG o JPG, guardar también en formato original optimizado
        if (['.jpg', '.jpeg', '.png'].includes(ext)) {
            await imagemin([filePath], {
                destination: outputDir,
                plugins: [
                    imageminMozjpeg({ quality: 80 }),
                    imageminPngquant({
                        quality: [0.6, 0.8]
                    })
                ]
            });
        }
        
        console.log(`✅ ${fileName} optimizada correctamente`);
    } catch (error) {
        console.error(`❌ Error al procesar ${filePath}:`, error);
    }
}

// Procesar todas las imágenes
async function processImages() {
    try {
        console.log('🔍 Buscando imágenes...');
        const files = fs.readdirSync(inputDir);
        const imageFiles = files.filter(file => 
            /.(jpg|jpeg|png|webp)$/i.test(file)
        );
        
        if (imageFiles.length === 0) {
            console.log('No se encontraron imágenes para optimizar.');
            return;
        }
        
        console.log(`🖼️  Encontradas ${imageFiles.length} imágenes para optimizar`);
        
        for (const file of imageFiles) {
            await optimizeImage(path.join(inputDir, file));
        }
        
        console.log('✨ Proceso de optimización completado');
    } catch (error) {
        console.error('❌ Error al procesar las imágenes:', error);
    }
}

// Ejecutar el proceso
processImages();
