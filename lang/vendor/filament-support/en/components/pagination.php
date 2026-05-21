<?php

return [

    'label' => 'Navigasi halaman',

    'overview' => '{1} Menampilkan 1 data|[2,*] Menampilkan :first sampai :last dari :total data',

    'fields' => [

        'records_per_page' => [

            'label' => 'Per halaman',

            'options' => [
                'all' => 'Semua',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'Pertama',
        ],

        'go_to_page' => [
            'label' => 'Ke halaman :page',
        ],

        'last' => [
            'label' => 'Terakhir',
        ],

        'next' => [
            'label' => 'Berikutnya',
        ],

        'previous' => [
            'label' => 'Sebelumnya',
        ],

    ],

];
