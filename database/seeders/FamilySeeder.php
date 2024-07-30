<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            'Tecnología' => [
                'Televisores' => [
                    'Accesorios para TV',
                    'LED',
                    'OLED',
                    'Otros',
                    'Proyectores',
                    'Insumos para TV',
                    'Televisores LGS'
                ],
                'Celulares' => [
                    'Accesorios',
                    'Audifonos',
                    'Baterías externas',
                    'Carcasas y láminas',
                    'Celulares y Smartphones',
                    'Reacondicionados',
                    'Smartwatch',
                    'Tarjeta de memoria',
                    'Telefonía inalámbricos',
                ],
                'Computación' => [
                    'Accesorios',
                    'Almacenamiento',
                    'Computadores de escritorio',
                    'Impresoras y Scanners',
                    'Laptops',
                    'Monitores',
                    'Otros',
                    'Software',
                    'Tablets',
                    'Todo computación',
                    'Camara web',
                    'Mouse y teclados',
                    'Audio y parlantes',
                    'Router y redes',
                ],
                'Videojuegos' => [
                    'Accesorios',
                    'Consolas',
                    'Nintendo',
                    'Otros',
                    'Playstation',
                    'Juegos',
                    'Mandos',
                    'Xbox'
                ],
                'Gaming' => [
                    'Juegos',
                    'Laptops gamer',
                    'Otros',
                    'PC gamer',
                    'Sillas gamer',
                    'Micrófonos gamer',
                    'Mouse gamer',
                    'Combos gamer',
                    'Teclados gamer',
                    'Audífonos gamer',
                ],
                'Audio' => [
                    'Accesorios',
                    'Audífonos',
                    'Equipos de sonido',
                    'Instrumentos musicales',
                    'Parlantes',
                    'Soundbar y Home Theater',
                    'Autoradios',
                    'Equipos de DJ',
                ],
                'Smart Home y domótica' => [
                    'Cocina smart',
                    'Iluminación inteligente',
                    'Seguridad inteligente',
                    'Camaras de seguridad',
                    'Enchufes inteligentes',
                    'Parlantes inteligentes',
                ],
                'Fotografía y video' => [
                    'Camararas acuáticas',
                    'Camaras compactas',
                    'Camaras de video',
                    'Drones',
                    'Lentes y accesorios',
                ],
                'Insumos para impresión' => [
                    'tintas',
                    'toners',
                ],
            ],
            'Electrohogar' => [
                'Refrigeración' => [
                    'Congeladores',
                    'Enfriadores de agua',
                    'Frigobar',
                    'Refrigeradoras',
                    'Vineras',
                ],
                'Cocina' => [
                    'Cocinas',
                    'Hornos',
                    'Microondas',
                    'Otros',
                    'Planchas',
                    'Refractarios',
                    'Sartenes',
                    'Vajillas',
                ],
                'Lavado' => [
                    'Centro de lavado',
                    'Lavadoras',
                    'Lavasecas',
                    'Otros',
                    'Secadoras',
                ],
                'Climatización' => [
                    'Aires acondicionados',
                    'Calefacción',
                    'Climatizadores',
                    'Otros',
                    'Ventiladores',
                ],
                'Limpieza' => [
                    'Aspiradoras',
                    'Otros',
                    'Planchas a vapor',
                    'Robot aspiradoras',
                ],
                'Electrodomestico' => [
                    'Batidoras',
                    'Cafeteras',
                    'Extractores',
                    'Licuadoras',
                    'Otros',
                    'Ollas arroceras',
                    'Sanducheras',
                    'Tostadoras',
                ]
            ],
            'Moda Hombre' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                ],
                'Ropa de home por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Trajes',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Corbatas',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado hombre' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Moda Mujer' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                    'Comodidad',
                    'Colección otoño invierno',
                ],
                'Ropa de mujer por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Vestidos',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado mujer' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Belleza' => [
                'Cuidado capilar' => [
                    'Acondicionadores',
                    'Cepillos',
                    'Cremas para peinar',
                    'Otros',
                    'Shampoo',
                    'Tintes',
                ],
                'Cuidado corporal' => [
                    'Cremas corporales',
                    'Cremas de manos',
                    'Cremas de pies',
                    'Cuidado de uñas',
                    'Desodorantes',
                    'Exfoliantes',
                    'Otros',
                ],
                'Dermocosmética' => [
                    'Cremas antiarrugas',
                    'Cremas antimanchas',
                    'Cremas hidratantes',
                    'Cremas nutritivas',
                    'Cremas reafirmantes',
                    'Cremas reductoras',
                    'Otros',
                ],
                'Electro belleza' => [
                    'Cepillos alisadores',
                    'Cepillos faciales',
                    'Cortadoras de cabello',
                    'Depiladoras',
                    'Otros',
                    'Planchas',
                    'Rizadores',
                    'Secadoras',
                ],
                'Maquillaje' => [
                    'Bases',
                    'Brochas',
                    'Correctores',
                    'Delineadores',
                    'Labiales',
                    'Otros',
                    'Polvos',
                    'Sombras',
                ],
                'Masaje y spa' => [
                    'Aceites',
                    'Cremas',
                    'Otros',
                ],
                'Perfumes' => [
                    'Femeninos',
                    'Masculinos',
                    'Otros',
                ],
                'Tratamientos faciales' => [
                    'Cremas antiarrugas',
                    'Cremas antimanchas',
                    'Cremas hidratantes',
                    'Cremas nutritivas',
                    'Cremas reafirmantes',
                    'Cremas reductoras',
                    'Otros',
                ],
                'pack regalo' => [
                    'Cuidado capilar',
                    'Cuidado corporal',
                    'Dermocosmética',
                    'Electro belleza',
                    'Maquillaje',
                    'Masaje y spa',
                    'Perfumes',
                    'Tratamientos faciales',
                ],
            ],
            'Supermercado' => [
                'Cuidado y protección adulta' => [
                    'Cuidado del adulto',
                    'Protección del adulto',
                ],
        
                'Cuidado y protección femenina' => [
                    'Cuidado femenino',
                    'Protección femenina',
                ],
        
                'Packs de salud y bienestar' => [
                    'Cuidado del adulto',
                    'Cuidado femenino',
                    'Protección del adulto',
                    'Protección femenina',
                ],
        
                'Desayuno' => [
                    'Café',
                    'Cereales',
                    'Galletas',
                    'Mermeladas',
                    'Otros',
                    'Pan',
                    'Té',
                ],
        
                'Embutidos y fiambres' => [
                    'Embutidos',
                    'Fiambres',
                ],
        
                'Cuidado personal' => [
                    'Afeitado',
                    'Cuidado bucal',
                    'Higiene corporal',
                    'Shampoo y acondicionador',
                    'Papel higiénico',
                    'Alcohol y desinfectantes',
                ],
                'Abarrotes' => [
                    'Aceites',
                    'Arroz',
                    'Azúcar',
                    'Bebidas',
                    'Café',
                    'Cereales',
                    'Conservas',
                    'Dulces',
                    'Enlatados',
                    'Fideos',
                    'Galletas',
                    'Harinas',
                    'Legumbres',
                    'Mermeladas',
                    'Otros',
                ],
                'Congelados' => [
                    'Carnes',
                    'Empanadas',
                    'Helados',
                    'Otros',
                    'Pescados',
                    'Pollos',
                    'Vegetales',
                ],
                'Cuidado del Bebé' => [
                    'Cuidado del bebé',
                    'Pañales',
                ],
                'Frutas y verduras' => [
                    'Frutas',
                    'Verduras',
                ],
                'Lácteos' => [
                    'Leche',
                    'Mantequilla',
                    'Otros',
                    'Quesos',
                    'Yogurt',
                ],
                'Licores' => [
                    'Cervezas',
                    'Espumantes',
                    'Otros',
                    'Piscos',
                    'Vinos',
                ],
                'Limpieza' => [
                    'Detergentes',
                    'Lavavajillas',
                    'Otros',
                    'Suavizantes',
                ],
                'Panetones' => [
                    'Panetones',
                ],
            ],
            'Deportes' => [
                'Suplementos' => [
                    'Aminoácidos',
                    'Creatina',
                    'Otros',
                    'Proteínas',
                ],
                'Bicicletas' => [
                    'Bicicletas',
                    'Otros',
                    'Repuestos',
                ],
                'Maquinas y Fitness' => [
                    'Accesorios',
                    'Bancas',
                    'Bicicletas estáticas',
                    'Caminadoras',
                    'Otros',
                    'Pesas',
                    'Plataformas',
                    'Remadoras',
                    'Steppers',
                ],
                'Accesorios' => [
                    'Accesorios',
                    'Bolsos',
                    'Otros',
                    'Relojes',
                ],
                'Deporte y aire libre' => [
                    'Balones',
                    'Bicicletas',
                    'Camping',
                    'Ciclismo',
                    'Fitness',
                    'Futbol',
                    'Otros',
                    'Skate',
                    'Tenis',
                ],
                'Mundo deporte' => [
                    'Basquet',
                    'Boxeo',
                    'Futbol',
                    'Golf',
                    'Otros',
                    'Tenis',
                ],
            ],
            'Mejoramiento del Hogar' => [
                'Automotriz' => [
                    'Accesorios',
                    'Audio',
                    'Cargadores',
                    'Otros',
                    'Parlantes',
                    'Reproductores',
                ],
                'Ferretería' => [
                    'Cerrajería',
                    'Electricidad',
                    'Gasfitería',
                    'Iluminación',
                    'Jardinería',
                    'Otros',
                    'Seguridad',
                ],
                'Herramientas eléctricas' => [
                    'Atornilladores',
                    'Caladoras',
                    'Cepillos',
                    'Compresores',
                    'Cortadoras',
                    'Esmeriles',
                    'Lijadoras',
                    'Otros',
                    'Pistolas de calor',
                    'Pulidoras',
                    'Sierras',
                    'Taladros',
                ],
                'Herramientas manuales' => [
                    'Alicates',
                    'Cinceles',
                    'Cortadores',
                    'Destornilladores',
                    'Llaves',
                    'Martillos',
                    'Otros',
                    'Pinzas',
                    'Sierras',
                    'Taladros',
                ],
                'Pinturas' => [
                    'Brochas',
                    'Otros',
                    'Pinturas',
                    'Rodillos',
                ],
                'Medición y trazado' => [
                    'Cintas métricas',
                    'Escuadras',
                    'Flexómetros',
                    'Niveles',
                    'Otros',
                    'Plomadas',
                    'Reglas',
                ],
            ],
            'Hogar' => [
                'Baño' => [
                    'Accesorios',
                    'Alfombras',
                    'Cortinas',
                    'Otros',
                    'Toallas',
                ],
                'Menaje de Cocina' => [
                    'Accesorios',
                    'Cubiertos',
                    'Otros',
                    'Ollas',
                    'Sartenes',
                    'Vajillas',
                ],
                'Decohogar' => [
                    'Flores y plantas',
                    'Iluminación',
                    'Otros',
                    'Relojes',
                    'Textiles',
                ],
                'Grill' => [
                    'Cilindros',
                    'Cajas chinas',
                    'Utensilios y accesorios',
                    'Parrillas'
                ],
                'Menaje de comedor' => [
                    'Vasos, copas y jarras',
                    'Tazas y platos',
                    'Juegos de té y café',
                ],
                'Organización' => [
                    'Cajas',
                    'Cestos',
                    'Otros',
                    'Percheros',
                    'Repisas',
                ],
            ],
            'Moda Infantil' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                    'Colección otoño invierno',
                ],
                'Ropa de niño por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado niño' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
                'Ropa de niña por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Vestidos',
                    'Zapatos',
                ],
                'Calzado niña' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Mascotas' => [
                'Alimento para mascotas' => [
                    'Alimento para gatos',
                    'Alimento para perros',
                    'Otros',
                ],
                'Accesorios para mascotas' => [
                    'Accesorios para gatos',
                    'Accesorios para perros',
                    'Otros',
                ],
                'Juguetes para mascotas' => [
                    'Juguetes para gatos',
                    'Juguetes para perros',
                    'Otros',
                ],
                'Cuidado de mascotas' => [
                    'Cuidado de gatos',
                    'Cuidado de perros',
                    'Otros',
                ],
                'Higiene de mascotas' => [
                    'Higiene de gatos',
                    'Higiene de perros',
                    'Otros',
                ],
                'Transporte de mascotas' => [
                    'Transporte de gatos',
                    'Transporte de perros',
                    'Otros',
                ],
            ],
            'Dormitorio' => [
                'Colchones' => [
                    'Colchones',
                    'Otros',
                ],
                'Ropa de cama' => [
                    'Almohadas',
                    'Cobertores',
                    'Otros',
                    'Sábanas',
                ],
                'Muebles' => [
                    'Bases',
                    'Cabeceras',
                    'Cómodas',
                    'Otros',
                    'Veladores',
                ],
            ],
            'Juguetería y Bebés' => [
                'Juguetes' => [
                    'Accesorios',
                    'Autos',
                    'Bloques',
                    'Cocinas',
                    'Disfraces',
                    'Figuras de acción',
                    'Juegos de mesa',
                    'Juguetes de madera',
                    'Juguetes didácticos',
                    'Juguetes electrónicos',
                    'Juguetes para bebés',
                    'Juguetes para niñas',
                    'Juguetes para niños',
                    'Lanzadores',
                    'Muñecas',
                    'Otros',
                    'Peluches',
                    'Pistas',
                    'Puzzles',
                    'Rompecabezas',
                    'Vehículos',
                ],
                'Bebés' => [
                    'Accesorios',
                    'Alimentación',
                    'Baño',
                    'Cuidado del bebé',
                    'Juguetes para bebés',
                    'Pañales',
                    'Ropa de bebé',
                    'Seguridad',
                    'Sillas de auto',
                    'Transporte',
                ],
            ],
            'Salud y Bienestar' => [
                'Cuidado de la salud' => [
                    'Accesorios',
                    'Cuidado de la salud',
                    'Otros',
                ],
                'Cuidado personal' => [
                    'Afeitado',
                    'Cuidado bucal',
                    'Higiene corporal',
                    'Shampoo y acondicionador',
                    'Papel higiénico',
                    'Alcohol y desinfectantes',
                ],
                'Cuidado sexual' => [
                    'Accesorios',
                    'Cuidado sexual',
                    'Otros',
                ],
                'Equipos médicos' => [
                    'Accesorios',
                    'Equipos médicos',
                    'Otros',
                ],
                'Medicamentos' => [
                    'Medicamentos',
                    'Otros',
                ],
                'Suplementos' => [
                    'Aminoácidos',
                    'Creatina',
                    'Otros',
                    'Proteínas',
                ],
            ],
            'Automotriz' => [
                'Accesorios' => [
                    'Accesorios',
                    'Audio',
                    'Cargadores',
                    'Otros',
                    'Parlantes',
                    'Reproductores',
                ],
                'Llantas' => [
                    'Llantas',
                    'Otros',
                ],
                'Repuestos' => [
                    'Accesorios',
                    'Otros',
                    'Repuestos',
                ],
            ],
            'Muebles' => [
                'Cocina' => [
                    'Accesorios',
                    'Alacenas',
                    'Cocinas',
                    'Comedores',
                    'Despensas',
                    'Mesas',
                    'Otros',
                    'Sillas',
                ],
                'Comedor' => [
                    'Accesorios',
                    'Alacenas',
                    'Comedores',
                    'Mesas',
                    'Otros',
                    'Sillas',
                ],
                'Dormitorio' => [
                    'Accesorios',
                    'Bases',
                    'Cabeceras',
                    'Cómodas',
                    'Otros',
                    'Veladores',
                ],
                'Oficina' => [
                    'Accesorios',
                    'Archivadores',
                    'Escritorios',
                    'Otros',
                    'Sillas',
                ],
                'Sala' => [
                    'Accesorios',
                    'Alacenas',
                    'Mesas',
                    'Otros',
                    'Sillas',
                    'Sofás',
                ],
                'Terraza y jardín' => [
                    'Accesorios',
                    'Alacenas',
                    'Mesas',
                    'Otros',
                    'Sillas',
                    'Sofás',
                ],
        
            ],
            'Librería' => [
                'Libros' => [
                    'Libros',
                    'Otros',
                ],
                'Libros digitales' => [
                    'Libros digitales',
                    'Otros',
                ],
                'Libros infantiles' => [
                    'Libros infantiles',
                    'Otros',
                ],
                'Libros juveniles' => [
                    'Libros juveniles',
                    'Otros',
                ],
                'Libros de texto' => [
                    'Libros de texto',
                    'Otros',
                ],
                'Libros de cocina' => [
                    'Libros de cocina',
                    'Otros',
                ],
                'Libros de autoayuda' => [
                    'Libros de autoayuda',
                    'Otros',
                ],
                'Libros de ficción' => [
                    'Libros de ficción',
                    'Otros',
                ],
                'Libros de no ficción' => [
                    'Libros de no ficción',
                    'Otros',
                ],
                'Libros de historia' => [
                    'Libros de historia',
                    'Otros',
                ],
                'Libros de arte' => [
                    'Libros de arte',
                    'Otros',
                ],
                'Libros de ciencia' => [
                    'Libros de ciencia',
                    'Otros',
                ],
                'Libros de medicina' => [
                    'Libros de medicina',
                    'Otros',
                ],
                'Libros de psicología' => [
                    'Libros de psicología',
                    'Otros',
                ],
                'Libros de economía' => [
                    'Libros de economía',
                    'Otros',
                ],
                'Libros de negocios' => [
                    'Libros de negocios',
                    'Otros',
                ],
                'Libros de marketing' => [
                    'Libros de marketing',
                    'Otros',
                ],
                'Libros de finanzas' => [
                    'Libros de finanzas',
                    'Otros',
                ],
                'Libros de derecho' => [
                    'Libros de derecho',
                    'Otros',
                ],
            ],
            'Farmacia' => [
                'Cuidado de la salud' => [
                    'Accesorios',
                    'Cuidado de la salud',
                    'Otros',
                ],
                'Cuidado personal' => [
                    'Afeitado',
                    'Cuidado bucal',
                    'Higiene corporal',
                    'Shampoo y acondicionador',
                    'Papel higiénico',
                    'Alcohol y desinfectantes',
                ],
                'Cuidado sexual' => [
                    'Accesorios',
                    'Cuidado sexual',
                    'Otros',
                ],
                'Equipos médicos' => [
                    'Accesorios',
                    'Equipos médicos',
                    'Otros',
                ],
                'Medicamentos' => [
                    'Medicamentos',
                    'Otros',
                ],
                'Suplementos' => [
                    'Aminoácidos',
                    'Creatina',
                    'Otros',
                    'Proteínas',
                ],
            ],
        ];

        foreach ($families as $family => $categories) 
        {
            $family = Family::create([
                'name' => $family
            ]);

            foreach ($categories as $category => $subcategories)
            {
                $category = Category::create([
                    'name' => $category,
                    'family_id' => $family->id
                ]);

                foreach ($subcategories as $subcategory)
                {
                    Subcategory::create([
                        'name' => $subcategory,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
