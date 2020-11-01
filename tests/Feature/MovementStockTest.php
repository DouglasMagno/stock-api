<?php

namespace Tests\Feature;

use Tests\TestCase;

class MovementStockTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateMovementStock()
    {
        // create a product
        $post = [
            [
                "name" => "Notebook",
                "price" => 1000,
                "qtd" => 2,
                "unit" => "und",
                "format" => "int"
            ]
        ];

        $response = $this->postJson('/api/products/create', $post);

        $products = $response->json();
        $this->assertIsArray($products, "Response of create products are not array response");

        // create addition movements
        $post = [
            [
                "product_id" => $products[0]["id"],
                "movement" => 2,
            ]
        ];

        $response = $this->postJson('/api/history/create', $post);

        $contentAddition = $response->json();
        $this->assertIsArray($contentAddition, "Response of create products are not array response");
        $this->assertEquals($products[0]["id"], $contentAddition[0]["product_id"], "The product id are not the same");
        $this->assertEquals($post[0]["movement"], $contentAddition[0]["movement"], "The product movement are not the same");
        $this->assertEquals(2, $contentAddition[0]["previous_balance"], "The product previous_balance are not 2");
        $this->assertEquals(($products[0]["qtd"] + $post[0]["movement"]), $contentAddition[0]["final_balance"], "The product final_balance is incorrect");
        $this->assertEquals($products[0]["price"], $contentAddition[0]["price"], "The product price is incorrect");
        $this->assertEquals($products[0]["name"], $contentAddition[0]["product_name"], "The product name is incorrect");

        $responseFind = $this->get("/api/products/find/{$products[0]["id"]}");
        $products[0] = $responseFind->json();
        // create sub movements
        $post = [
            [
                "product_id" => $products[0]["id"],
                "movement" => -2,
            ]
        ];

        $response = $this->postJson('/api/history/create', $post);

        $contentAddition = $response->json();
        $this->assertIsArray($contentAddition, "Response of create products are not array response");
        $this->assertEquals($products[0]["id"], $contentAddition[0]["product_id"], "The product id are not the same");
        $this->assertEquals($post[0]["movement"], $contentAddition[0]["movement"], "The product movement are not the same");
        $this->assertEquals(4, $contentAddition[0]["previous_balance"], "The product previous_balance are not 4");
        $this->assertEquals(($products[0]["qtd"] + $post[0]["movement"]), $contentAddition[0]["final_balance"], "The product final_balance is incorrect");
        $this->assertEquals($products[0]["price"], $contentAddition[0]["price"], "The product price is incorrect");
        $this->assertEquals($products[0]["name"], $contentAddition[0]["product_name"], "The product name is incorrect");
    }
}
