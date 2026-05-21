<?php

return [

    'single' => [

        'label' => 'Hapus',

        'modal' => [
            'heading' => 'Hapus :label',
            'actions' => [
                'delete' => ['label' => 'Ya, Hapus'],
            ],
        ],

        'notifications' => [
            'deleted' => ['title' => 'Berhasil dihapus'],
        ],

    ],

    'multiple' => [

        'label' => 'Hapus yang dipilih',

        'modal' => [
            'heading' => 'Hapus :label yang dipilih',
            'actions' => [
                'delete' => ['label' => 'Ya, Hapus Semua'],
            ],
        ],

        'notifications' => [
            'deleted' => ['title' => 'Berhasil dihapus'],
            'deleted_partial' => [
                'title' => 'Dihapus :count dari :total',
                'missing_authorization_failure_message' => 'Anda tidak punya izin untuk menghapus :count.',
                'missing_processing_failure_message' => ':count tidak dapat dihapus.',
            ],
            'deleted_none' => [
                'title' => 'Gagal menghapus',
                'missing_authorization_failure_message' => 'Anda tidak punya izin untuk menghapus :count.',
                'missing_processing_failure_message' => ':count tidak dapat dihapus.',
            ],
        ],

    ],

];
