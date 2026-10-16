<?php

/*
|--------------------------------------------------------------------------
| Official Merchandise
|--------------------------------------------------------------------------
|
| Parsed from the merch booth banner (MerchBooth - D 100x150cm). Shared by
| the /merchandise page and the Loot Shop section on the home page.
| Images live in public/media/images/merchandise/{image}.webp; prices are
| in thousands of rupiah, as printed on the banner ("RP 350K").
|
*/

return [
    'catalog' => 'official-merchandise-catalog',
    'qr' => 'merch-qr',

    'categories' => [
        [
            'key' => 'igx',
            'name' => 'IGX Official Merchandise',
            'short' => 'IGX Official',
            'color' => 'accent',
            'items' => [
                ['image' => 'comic-book-card-set', 'name' => 'Comic Book + Card Set', 'note' => 'Gacha · 6 types', 'price' => 100],
                ['image' => 'cooper-eco-bag', 'name' => 'Cooper Eco Bag', 'note' => 'Foldable', 'price' => 169],
                ['image' => 'tshirt-black', 'name' => 'T-Shirt (Black)', 'note' => null, 'price' => 350],
                ['image' => 'nitari-clicker', 'name' => 'Nitari Clicker', 'note' => null, 'price' => 80],
                ['image' => 'lord-xcape-clicker', 'name' => 'Lord Xcape Clicker', 'note' => null, 'price' => 120],
                ['image' => 'snapback-cap', 'name' => 'Snapback Cap', 'note' => null, 'price' => 249],
                ['image' => 'drewcat-deck-box', 'name' => 'Drewcat Deck Box', 'note' => null, 'price' => 299],
                ['image' => 'tshirt-indigo', 'name' => 'T-Shirt (Indigo)', 'note' => null, 'price' => 350],
            ],
        ],
        [
            'key' => 'tokidoki',
            'name' => 'Tokidoki Collab. Merchandise',
            'short' => 'Tokidoki Collab',
            'color' => 'cyan',
            'items' => [
                ['image' => 'tokidoki-enamel-pin-set', 'name' => 'Enamel Pin Set', 'note' => 'G.I.X Squad: Drewcat, Nitari, Suga', 'price' => 250],
                ['image' => 'tokidoki-tshirt-nitari-black', 'name' => 'T-Shirt Nitari (Black)', 'note' => null, 'price' => 500],
                ['image' => 'tokidoki-tshirt-drewcat-white', 'name' => 'T-Shirt Drewcat (White)', 'note' => null, 'price' => 500],
                ['image' => 'tokidoki-tshirt-suga-black', 'name' => 'T-Shirt Suga (Black)', 'note' => null, 'price' => 500],
                ['image' => 'tokidoki-tote-bag', 'name' => 'Tote Bag', 'note' => null, 'price' => 350],
                ['image' => 'tokidoki-tshirt-nitari-white', 'name' => 'T-Shirt Nitari (White)', 'note' => null, 'price' => 500],
                ['image' => 'tokidoki-tshirt-drewcat-black', 'name' => 'T-Shirt Drewcat (Black)', 'note' => null, 'price' => 500],
                ['image' => 'tokidoki-tshirt-suga-white', 'name' => 'T-Shirt Suga (White)', 'note' => null, 'price' => 500],
            ],
        ],
        [
            'key' => 'chiitan',
            'name' => 'Chiitan☆ Collab. Merchandise',
            'short' => 'Chiitan☆ Collab',
            'color' => 'primary',
            'items' => [
                ['image' => 'chiitan-hand-puppet', 'name' => 'Hand Puppet', 'note' => null, 'price' => 299],
                ['image' => 'chiitan-canvas-pouch', 'name' => 'Canvas Pouch', 'note' => null, 'price' => 149],
                ['image' => 'chiitan-lenticular-keychain', 'name' => 'Lenticular Keychain', 'note' => 'Two-sided', 'price' => 129],
                ['image' => 'chiitan-tshirt-chiitan-x-igx', 'name' => 'T-Shirt Chiitan☆ × IGX', 'note' => 'Illustrated by Rianti Hidayat', 'price' => 249],
                ['image' => 'chiitan-cheering-stick', 'name' => 'Cheering Stick', 'note' => 'Gacha · 3 types', 'price' => 80],
                ['image' => 'chiitan-sticker-sheet', 'name' => 'Sticker Sheet', 'note' => null, 'price' => 49],
                ['image' => 'chiitan-tshirt-chiitan-mania', 'name' => 'T-Shirt Chiitan☆ Mania', 'note' => null, 'price' => 249],
                ['image' => 'chiitan-tshirt-bajaj', 'name' => 'T-Shirt Bajaj', 'note' => null, 'price' => 249],
            ],
        ],
    ],
];
