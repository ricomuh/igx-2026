<?php

test('map page renders successfully with floor plan', function () {
    $response = $this->get(route('map'));

    $response->assertStatus(200);
    $response->assertSee('IGX 2026 EVENT MAP');
    $response->assertSee('map.webp');
    $response->assertSee('panzoom');
});

test('map preview widget is rendered on other pages', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('mapWidgetContainer');
    $response->assertSee('map-thumb.webp');
});
