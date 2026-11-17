<?php

/*
 * Mock catalog (fictional products, no real test names), ported from Version A.
 * Localized fields are keyed by locale: 'it' and 'es'.
 */

return [
    'categories' => [
        [
            'id' => 'clinica',
            'label' => [
                'it' => 'Clinica e Neuropsicologia',
                'es' => 'Clínica y Neuropsicología',
            ],
        ],
        [
            'id' => 'scuola',
            'label' => [
                'it' => 'Scuola ed Età evolutiva',
                'es' => 'Escuela y Edad evolutiva',
            ],
        ],
        [
            'id' => 'lavoro',
            'label' => [
                'it' => 'Lavoro e Organizzazioni',
                'es' => 'Trabajo y Organizaciones',
            ],
        ],
        [
            'id' => 'formazione',
            'label' => [
                'it' => 'Formazione',
                'es' => 'Formación',
            ],
        ],
    ],
    'formats' => [
        'cartaceo',
        'digitale',
        'corso-online',
        'in-presenza',
    ],
    'products' => [
        [
            'id' => 'p01',
            'slug' => 'bva-2-batteria-valutazione-attentiva',
            'name' => 'BVA-2 · Batteria di Valutazione Attentiva',
            'kind' => 'test',
            'category' => 'clinica',
            'format' => 'cartaceo',
            'people' => [
                'M. Ferraris',
                'L. Conti',
            ],
            'summary' => [
                'it' => 'Valuta attenzione selettiva, sostenuta e divisa in bambini e adolescenti.',
                'es' => 'Evalúa la atención selectiva, sostenida y dividida en niños y adolescentes.',
            ],
            'description' => [
                'it' => 'Batteria di prove carta-matita per l\'assessment dei processi attentivi in età evolutiva. Utile nell\'inquadramento di difficoltà di concentrazione a scuola e nel percorso diagnostico dei disturbi del neurosviluppo, con norme per fascia d\'età e profilo grafico dei punteggi.',
                'es' => 'Batería de pruebas de lápiz y papel para evaluar los procesos atencionales en la edad evolutiva. Útil para encuadrar dificultades de concentración escolar y en el proceso diagnóstico de los trastornos del neurodesarrollo, con normas por edad y perfil gráfico de puntuaciones.',
            ],
            'highlights' => [
                'it' => [
                    'Attenzione selettiva, sostenuta e divisa',
                    'Norme italiane per fascia d\'età',
                    'Profilo grafico dei punteggi',
                ],
                'es' => [
                    'Atención selectiva, sostenida y dividida',
                    'Normas italianas por edad',
                    'Perfil gráfico de puntuaciones',
                ],
            ],
            'price' => 320.0,
            'salePrice' => 272.0,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 320.0,
                    'salePrice' => 272.0,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => 'Protocolli di notazione (25)',
                        'es' => 'Protocolos de registro (25)',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 95.0,
                    'salePrice' => 80.75,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 110.0,
                    'salePrice' => 93.5,
                ],
            ],
            'ageRange' => [
                'min' => 6,
                'max' => 16,
            ],
            'durationMinutes' => [
                'min' => 30,
                'max' => 40,
            ],
            'administration' => 'individual',
            'qualification' => 'B',
            'includes' => [
                'it' => [
                    'Manuale con dati normativi',
                    'Fascicoli stimolo',
                    '25 protocolli di notazione',
                    'Griglie di correzione',
                ],
                'es' => [
                    'Manual con datos normativos',
                    'Cuadernillos de estímulos',
                    '25 protocolos de registro',
                    'Plantillas de corrección',
                ],
            ],
            'photoId' => '1516534775068-ba3e7458af70',
            'imageAlt' => [
                'it' => 'Ragazza concentrata mentre lavora al computer',
                'es' => 'Chica concentrada trabajando con el ordenador',
            ],
        ],
        [
            'id' => 'p02',
            'slug' => 'sca-2-screening-cognitivo-adulti',
            'name' => 'SCA-2 · Scala di Screening Cognitivo per Adulti',
            'kind' => 'test',
            'category' => 'clinica',
            'format' => 'digitale',
            'people' => [
                'R. Bianchi',
                'S. Greco',
            ],
            'summary' => [
                'it' => 'Screening breve di memoria, attenzione, linguaggio e funzioni esecutive negli adulti.',
                'es' => 'Cribado breve de memoria, atención, lenguaje y funciones ejecutivas en adultos.',
            ],
            'description' => [
                'it' => 'In meno di 20 minuti offre un quadro sintetico delle principali funzioni cognitive e aiuta a decidere se approfondire con una valutazione neuropsicologica completa. La nuova edizione aggiorna i dati normativi e introduce la somministrazione digitale con report automatico.',
                'es' => 'En menos de 20 minutos ofrece una visión sintética de las principales funciones cognitivas y ayuda a decidir si profundizar con una evaluación neuropsicológica completa. La nueva edición actualiza los datos normativos e introduce la aplicación digital con informe automático.',
            ],
            'highlights' => [
                'it' => [
                    'Memoria, attenzione, linguaggio e funzioni esecutive',
                    'Report automatico',
                    'Norme aggiornate 2026',
                ],
                'es' => [
                    'Memoria, atención, lenguaje y funciones ejecutivas',
                    'Informe automático',
                    'Normas actualizadas 2026',
                ],
            ],
            'price' => 1250.0,
            'salePrice' => 1062.5,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 1250.0,
                    'salePrice' => 1062.5,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => '25 somministrazioni online',
                        'es' => '25 aplicaciones online',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 160.0,
                    'salePrice' => 136.0,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 95.0,
                    'salePrice' => 80.75,
                ],
            ],
            'ageRange' => [
                'min' => 18,
                'max' => 90,
            ],
            'durationMinutes' => [
                'min' => 15,
                'max' => 20,
            ],
            'administration' => 'individual',
            'qualification' => 'B',
            'includes' => [
                'it' => [
                    'Manuale con dati normativi italiani',
                    '25 somministrazioni su piattaforma',
                    'Report automatico del profilo',
                ],
                'es' => [
                    'Manual con datos normativos italianos',
                    '25 aplicaciones en la plataforma',
                    'Informe automático del perfil',
                ],
            ],
            'isNew' => true,
            'photoId' => '1559757148-5c350d0d3c56',
            'imageAlt' => [
                'it' => 'Modello anatomico di cervello umano',
                'es' => 'Modelo anatómico de cerebro humano',
            ],
        ],
        [
            'id' => 'p03',
            'slug' => 'pal-profilo-abilita-lettura',
            'name' => 'PAL · Profilo delle Abilità di Lettura',
            'kind' => 'test',
            'category' => 'scuola',
            'format' => 'cartaceo',
            'people' => [
                'C. Moretti',
            ],
            'summary' => [
                'it' => 'Rapidità e correttezza di lettura e comprensione del testo nella scuola primaria e secondaria.',
                'es' => 'Velocidad y precisión lectora y comprensión de textos en primaria y secundaria.',
            ],
            'description' => [
                'it' => 'Prove di lettura di brano, parole e non-parole con compiti di comprensione. Supporta l\'individuazione precoce delle difficoltà di apprendimento e il monitoraggio dei progressi durante l\'anno scolastico.',
                'es' => 'Pruebas de lectura de texto, palabras y pseudopalabras con tareas de comprensión. Apoya la detección temprana de dificultades de aprendizaje y el seguimiento de los progresos durante el curso escolar.',
            ],
            'highlights' => [
                'it' => [
                    'Brano, parole e non-parole',
                    'Comprensione del testo',
                    'Uso in classe e in ambulatorio',
                ],
                'es' => [
                    'Texto, palabras y pseudopalabras',
                    'Comprensión lectora',
                    'Uso en aula y en consulta',
                ],
            ],
            'price' => 185.0,
            'salePrice' => 157.25,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 185.0,
                    'salePrice' => 157.25,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => 'Protocolli di notazione (25)',
                        'es' => 'Protocolos de registro (25)',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 60.0,
                    'salePrice' => 51.0,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 70.0,
                    'salePrice' => 59.5,
                ],
            ],
            'ageRange' => [
                'min' => 7,
                'max' => 14,
            ],
            'durationMinutes' => [
                'min' => 20,
                'max' => 30,
            ],
            'administration' => 'individual-or-group',
            'qualification' => 'A',
            'includes' => [
                'it' => [
                    'Manuale',
                    'Fascicoli di lettura',
                    '25 protocolli',
                    'Tabelle normative per classe',
                ],
                'es' => [
                    'Manual',
                    'Cuadernillos de lectura',
                    '25 protocolos',
                    'Tablas normativas por curso',
                ],
            ],
            'photoId' => '1588072432836-e10032774350',
            'imageAlt' => [
                'it' => 'Bambini che leggono e scrivono in classe',
                'es' => 'Niños leyendo y escribiendo en clase',
            ],
        ],
        [
            'id' => 'p04',
            'slug' => 'qeri-questionario-emotivo-relazionale-infanzia',
            'name' => 'QERI · Questionario Emotivo-Relazionale per l\'Infanzia',
            'kind' => 'test',
            'category' => 'scuola',
            'format' => 'digitale',
            'people' => [
                'A. Rinaldi',
                'F. Gallo',
            ],
            'summary' => [
                'it' => 'Rileva benessere emotivo e competenze relazionali con versioni per genitori e insegnanti.',
                'es' => 'Detecta bienestar emocional y competencias relacionales con versiones para padres y docentes.',
            ],
            'description' => [
                'it' => 'Questionario multi-informatore che descrive regolazione emotiva, relazioni con i pari e comportamenti prosociali. Le versioni per genitori e insegnanti permettono di confrontare i contesti di vita del bambino.',
                'es' => 'Cuestionario multiinformante que describe la regulación emocional, las relaciones con los pares y las conductas prosociales. Las versiones para padres y docentes permiten comparar los contextos de vida del niño.',
            ],
            'highlights' => [
                'it' => [
                    'Versioni genitori e insegnanti',
                    'Regolazione emotiva e relazioni',
                    'Confronto tra informatori',
                ],
                'es' => [
                    'Versiones para padres y docentes',
                    'Regulación emocional y relaciones',
                    'Comparación entre informantes',
                ],
            ],
            'price' => 240.0,
            'salePrice' => 204.0,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 240.0,
                    'salePrice' => 204.0,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => '25 somministrazioni online',
                        'es' => '25 aplicaciones online',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 120.0,
                    'salePrice' => 102.0,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 80.0,
                    'salePrice' => 68.0,
                ],
            ],
            'ageRange' => [
                'min' => 4,
                'max' => 11,
            ],
            'durationMinutes' => [
                'min' => 10,
                'max' => 15,
            ],
            'administration' => 'individual',
            'qualification' => 'B',
            'includes' => [
                'it' => [
                    'Manuale',
                    '25 somministrazioni online',
                    'Report di confronto tra informatori',
                ],
                'es' => [
                    'Manual',
                    '25 aplicaciones online',
                    'Informe de comparación entre informantes',
                ],
            ],
            'photoId' => '1503676260728-1c00da094a0b',
            'imageAlt' => [
                'it' => 'Libri, matite colorate e cubi dell\'alfabeto su un banco',
                'es' => 'Libros, lápices de colores y cubos del alfabeto sobre un pupitre',
            ],
        ],
        [
            'id' => 'p05',
            'slug' => 'ict-inventario-competenze-trasversali',
            'name' => 'ICT · Inventario delle Competenze Trasversali',
            'kind' => 'test',
            'category' => 'lavoro',
            'format' => 'digitale',
            'people' => [
                'P. Lombardi',
            ],
            'summary' => [
                'it' => 'Misura le soft skill per selezione, sviluppo del personale e orientamento professionale.',
                'es' => 'Mide las competencias transversales para selección, desarrollo de personas y orientación profesional.',
            ],
            'description' => [
                'it' => 'Inventario self-report su comunicazione, problem solving, gestione dello stress e lavoro in team. Il report restituisce punti di forza e aree di sviluppo, pronto per il colloquio di feedback.',
                'es' => 'Inventario de autoinforme sobre comunicación, resolución de problemas, gestión del estrés y trabajo en equipo. El informe devuelve fortalezas y áreas de mejora, listo para la entrevista de feedback.',
            ],
            'highlights' => [
                'it' => [
                    'Comunicazione e problem solving',
                    'Gestione dello stress',
                    'Report pronto per il feedback',
                ],
                'es' => [
                    'Comunicación y resolución de problemas',
                    'Gestión del estrés',
                    'Informe listo para el feedback',
                ],
            ],
            'price' => 890.0,
            'salePrice' => 756.5,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 890.0,
                    'salePrice' => 756.5,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => '25 somministrazioni online',
                        'es' => '25 aplicaciones online',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 210.0,
                    'salePrice' => 178.5,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 90.0,
                    'salePrice' => 76.5,
                ],
            ],
            'ageRange' => [
                'min' => 18,
            ],
            'durationMinutes' => [
                'min' => 25,
                'max' => 35,
            ],
            'administration' => 'individual-or-group',
            'qualification' => 'A',
            'includes' => [
                'it' => [
                    'Manuale',
                    '25 somministrazioni online',
                    'Report individuale di sviluppo',
                ],
                'es' => [
                    'Manual',
                    '25 aplicaciones online',
                    'Informe individual de desarrollo',
                ],
            ],
            'photoId' => '1552664730-d307ca884978',
            'imageAlt' => [
                'it' => 'Team in riunione davanti a una lavagna con post-it',
                'es' => 'Equipo reunido frente a una pizarra con notas adhesivas',
            ],
        ],
        [
            'id' => 'p06',
            'slug' => 'amt-assessment-motivazionale-team',
            'name' => 'AMT · Assessment Motivazionale per Team',
            'kind' => 'test',
            'category' => 'lavoro',
            'format' => 'cartaceo',
            'people' => [
                'E. Costa',
                'D. Villa',
            ],
            'summary' => [
                'it' => 'Analizza motivazione e clima nei gruppi di lavoro per orientare gli interventi organizzativi.',
                'es' => 'Analiza la motivación y el clima en los equipos de trabajo para orientar las intervenciones organizacionales.',
            ],
            'description' => [
                'it' => 'Questionario di gruppo che esplora fattori motivazionali, senso di appartenenza e qualità della collaborazione. Pensato per psicologi del lavoro e consulenti HR che progettano percorsi di team building e benessere organizzativo.',
                'es' => 'Cuestionario grupal que explora factores motivacionales, sentido de pertenencia y calidad de la colaboración. Pensado para psicólogos del trabajo y consultores de RR. HH. que diseñan programas de team building y bienestar organizacional.',
            ],
            'highlights' => [
                'it' => [
                    'Motivazione e clima di gruppo',
                    'Somministrazione collettiva',
                    'Indicazioni per l\'intervento',
                ],
                'es' => [
                    'Motivación y clima grupal',
                    'Aplicación colectiva',
                    'Pautas para la intervención',
                ],
            ],
            'price' => 410.0,
            'salePrice' => 348.5,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 410.0,
                    'salePrice' => 348.5,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => 'Questionari (25)',
                        'es' => 'Cuestionarios (25)',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 130.0,
                    'salePrice' => 110.5,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 85.0,
                    'salePrice' => 72.25,
                ],
            ],
            'ageRange' => [
                'min' => 18,
            ],
            'durationMinutes' => [
                'min' => 20,
                'max' => 25,
            ],
            'administration' => 'group',
            'qualification' => 'A',
            'includes' => [
                'it' => [
                    'Manuale',
                    '25 questionari',
                    'Fogli di profilo di gruppo',
                ],
                'es' => [
                    'Manual',
                    '25 cuestionarios',
                    'Hojas de perfil grupal',
                ],
            ],
            'photoId' => '1600880292203-757bb62b4baf',
            'imageAlt' => [
                'it' => 'Due colleghi si danno il cinque in ufficio',
                'es' => 'Dos compañeros chocan las manos en la oficina',
            ],
        ],
        [
            'id' => 'p07',
            'slug' => 'sbl-scala-benessere-lavorativo',
            'name' => 'SBL · Scala di Benessere Lavorativo',
            'kind' => 'test',
            'category' => 'lavoro',
            'format' => 'digitale',
            'people' => [
                'G. Ricci',
                'M. Sala',
            ],
            'summary' => [
                'it' => 'Valuta stress lavoro-correlato, carico emotivo e risorse personali dei collaboratori.',
                'es' => 'Evalúa el estrés laboral, la carga emocional y los recursos personales de los colaboradores.',
            ],
            'description' => [
                'it' => 'Scala breve per il monitoraggio del benessere psicologico in azienda: stress percepito, recupero, supporto sociale e rischio di burnout. Risultati aggregati e anonimi per la valutazione dei rischi psicosociali.',
                'es' => 'Escala breve para monitorear el bienestar psicológico en la empresa: estrés percibido, recuperación, apoyo social y riesgo de burnout. Resultados agregados y anónimos para la evaluación de riesgos psicosociales.',
            ],
            'highlights' => [
                'it' => [
                    'Stress percepito e rischio burnout',
                    'Report aggregati anonimi',
                    'Somministrazione in 10 minuti',
                ],
                'es' => [
                    'Estrés percibido y riesgo de burnout',
                    'Informes agregados anónimos',
                    'Aplicación en 10 minutos',
                ],
            ],
            'price' => 290.0,
            'salePrice' => 246.5,
            'editions' => [
                [
                    'id' => 'kit',
                    'label' => [
                        'it' => 'Kit completo',
                        'es' => 'Kit completo',
                    ],
                    'detail' => [
                        'it' => 'Manuale, materiali di somministrazione e griglie',
                        'es' => 'Manual, materiales de aplicación y plantillas',
                    ],
                    'price' => 290.0,
                    'salePrice' => 246.5,
                ],
                [
                    'id' => 'refill',
                    'label' => [
                        'it' => '25 somministrazioni online',
                        'es' => '25 aplicaciones online',
                    ],
                    'detail' => [
                        'it' => 'Confezione di ricambio',
                        'es' => 'Paquete de reposición',
                    ],
                    'price' => 140.0,
                    'salePrice' => 119.0,
                ],
                [
                    'id' => 'manual',
                    'label' => [
                        'it' => 'Manuale',
                        'es' => 'Manual',
                    ],
                    'detail' => [
                        'it' => 'Norme, procedure e casi clinici',
                        'es' => 'Normas, procedimientos y casos clínicos',
                    ],
                    'price' => 70.0,
                    'salePrice' => 59.5,
                ],
            ],
            'ageRange' => [
                'min' => 18,
            ],
            'durationMinutes' => [
                'min' => 8,
                'max' => 10,
            ],
            'administration' => 'individual-or-group',
            'qualification' => 'A',
            'includes' => [
                'it' => [
                    'Manuale',
                    '25 somministrazioni online',
                    'Report di gruppo anonimo',
                ],
                'es' => [
                    'Manual',
                    '25 aplicaciones online',
                    'Informe grupal anónimo',
                ],
            ],
            'photoId' => '1531482615713-2afd69097998',
            'imageAlt' => [
                'it' => 'Colleghi che lavorano insieme al computer',
                'es' => 'Compañeros trabajando juntos frente al ordenador',
            ],
        ],
        [
            'id' => 'p08',
            'slug' => 'corso-valutazione-neuropsicologica-eta-evolutiva',
            'name' => 'Valutazione neuropsicologica in età evolutiva',
            'kind' => 'course',
            'category' => 'formazione',
            'format' => 'corso-online',
            'people' => [
                'Dott.ssa Giulia Marchetti',
            ],
            'summary' => [
                'it' => 'Dalla scelta degli strumenti alla restituzione alla famiglia: un percorso pratico con casi reali.',
                'es' => 'De la elección de los instrumentos a la devolución a la familia: un recorrido práctico con casos reales.',
            ],
            'description' => [
                'it' => 'Corso online in diretta con esercitazioni su protocolli anonimizzati. Si approfondiscono attenzione, memoria e funzioni esecutive nel bambino, l\'integrazione dei risultati e la stesura della relazione clinica.',
                'es' => 'Curso online en directo con ejercicios sobre protocolos anonimizados. Se profundiza en la atención, la memoria y las funciones ejecutivas en el niño, la integración de resultados y la redacción del informe clínico.',
            ],
            'highlights' => [
                'it' => [
                    '16 ore in diretta',
                    'Casi clinici anonimizzati',
                    'Attestato di partecipazione',
                ],
                'es' => [
                    '16 horas en directo',
                    'Casos clínicos anonimizados',
                    'Certificado de participación',
                ],
            ],
            'price' => 450.0,
            'salePrice' => 360.0,
            'editions' => [
                [
                    'id' => 'seat',
                    'label' => [
                        'it' => 'Iscrizione',
                        'es' => 'Inscripción',
                    ],
                    'detail' => [
                        'it' => 'Accesso al corso, materiali e attestato',
                        'es' => 'Acceso al curso, materiales y certificado',
                    ],
                    'price' => 450.0,
                    'salePrice' => 360.0,
                ],
            ],
            'startDate' => '2027-01-15',
            'hours' => 16,
            'ecmCredits' => 24,
            'photoId' => '1606761568499-6d2451b23c66',
            'imageAlt' => [
                'it' => 'Due professioniste seguono una lezione online al portatile',
                'es' => 'Dos profesionales siguen una clase online en el portátil',
            ],
        ],
        [
            'id' => 'p09',
            'slug' => 'corso-somministrazione-scoring-test-personalita',
            'name' => 'Somministrazione e scoring dei test di personalità',
            'kind' => 'course',
            'category' => 'formazione',
            'format' => 'in-presenza',
            'people' => [
                'Dott. Luca Fontana',
            ],
            'summary' => [
                'it' => 'Due giornate in aula per padroneggiare somministrazione, correzione e interpretazione.',
                'es' => 'Dos jornadas presenciales para dominar la aplicación, la corrección y la interpretación.',
            ],
            'description' => [
                'it' => 'Workshop in presenza con esercitazioni a coppie: setting, istruzioni standardizzate, errori frequenti di scoring e lettura integrata dei profili. Posti limitati per favorire la pratica guidata.',
                'es' => 'Taller presencial con ejercicios en parejas: encuadre, instrucciones estandarizadas, errores frecuentes de corrección y lectura integrada de los perfiles. Plazas limitadas para favorecer la práctica guiada.',
            ],
            'highlights' => [
                'it' => [
                    '2 giornate a Milano',
                    'Esercitazioni a coppie',
                    'Posti limitati',
                ],
                'es' => [
                    '2 jornadas en Milán',
                    'Ejercicios en parejas',
                    'Plazas limitadas',
                ],
            ],
            'price' => 620.0,
            'salePrice' => 527.0,
            'editions' => [
                [
                    'id' => 'seat',
                    'label' => [
                        'it' => 'Iscrizione',
                        'es' => 'Inscripción',
                    ],
                    'detail' => [
                        'it' => 'Accesso al corso, materiali e attestato',
                        'es' => 'Acceso al curso, materiales y certificado',
                    ],
                    'price' => 620.0,
                    'salePrice' => 527.0,
                ],
            ],
            'startDate' => '2027-02-06',
            'hours' => 14,
            'ecmCredits' => 18,
            'location' => 'Milano',
            'photoId' => '1544717305-2782549b5136',
            'imageAlt' => [
                'it' => 'Aula per conferenze con schermo e sedute',
                'es' => 'Aula de conferencias con pantalla y asientos',
            ],
        ],
        [
            'id' => 'p10',
            'slug' => 'corso-psicodiagnostica-clinica-colloquio-report',
            'name' => 'Psicodiagnostica clinica: dal colloquio al report',
            'kind' => 'course',
            'category' => 'formazione',
            'format' => 'corso-online',
            'people' => [
                'Dott.ssa Elena Sartori',
            ],
            'summary' => [
                'it' => 'Integrare colloquio, test e osservazione in una relazione psicodiagnostica chiara ed etica.',
                'es' => 'Integrar entrevista, tests y observación en un informe psicodiagnóstico claro y ético.',
            ],
            'description' => [
                'it' => 'Percorso online in moduli: conduzione del colloquio anamnestico, selezione della batteria, integrazione dei dati e restituzione al paziente. Include modelli di report e supervisione di gruppo finale.',
                'es' => 'Recorrido online por módulos: conducción de la entrevista anamnésica, selección de la batería, integración de datos y devolución al paciente. Incluye modelos de informe y una supervisión grupal final.',
            ],
            'highlights' => [
                'it' => [
                    '32 ore in moduli',
                    'Modelli di report',
                    'Supervisione di gruppo',
                ],
                'es' => [
                    '32 horas por módulos',
                    'Modelos de informe',
                    'Supervisión grupal',
                ],
            ],
            'price' => 980.0,
            'salePrice' => 833.0,
            'editions' => [
                [
                    'id' => 'seat',
                    'label' => [
                        'it' => 'Iscrizione',
                        'es' => 'Inscripción',
                    ],
                    'detail' => [
                        'it' => 'Accesso al corso, materiali e attestato',
                        'es' => 'Acceso al curso, materiales y certificado',
                    ],
                    'price' => 980.0,
                    'salePrice' => 833.0,
                ],
            ],
            'startDate' => '2027-03-03',
            'hours' => 32,
            'ecmCredits' => 40,
            'photoId' => '1434030216411-0b793f4b4173',
            'imageAlt' => [
                'it' => 'Professionista che prende appunti a mano',
                'es' => 'Profesional tomando notas a mano',
            ],
        ],
    ],
];
