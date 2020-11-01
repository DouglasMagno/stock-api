<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);

        $content = $response->json();
        $this->assertIsArray($content, "Response of get all products are not array response");

        if (is_array($content)){
            if (count($content)){
                $asserts = [
                    "id" => "assertIsInt",
                    "name" => "assertIsString",
                    "price" => "assertIsInt",
                    "qtd" => "assertIsInt",
                    "unit" => "assertIsString",
                    "format" => "assertIsString",
                    "created_at" => "assertIsString",
                    "updated_at" => "assertIsString",
                    "qtd_to_show" => "assertIsString",
                    "histories" => "assertIsArray",
                ];
                foreach ($asserts as $index => $assert) {
                    $this->assertArrayHasKey($index, $content[0], "Product does not have {$index} attribute");
                    $this->{$assert}($content[0][$index], "Product {$index} is cant {$assert}");
                }
            }
        }
    }

    public function testCreateProduct()
    {
        $post = [
            [
                "name" => "Notebook",
                "price" => 1000,
                "qtd" => 2,
                "unit" => "und",
                "format" => "int"
            ],
            [
                "name" => "Rice",
                "price" => 2000,
                "qtd" => 1.5253,
                "unit" => "kilograms",
                "format" => "double"
            ],
        ];

        $response = $this->postJson('/api/products/create', $post);

        $content = $response->json();
        $this->assertIsArray($content, "Response of create products are not array response");

        foreach ($post as $index => $product) {
            foreach ($product as $field => $value) {
                $this->assertEquals($post[$index][$field], $content[$index][$field], "The product index {$index} on the field {$field} are not equal with the response");
            }
            $this->assertEquals($content[$index]['id'], $content[$index]['histories'][0]['product_id'], "the history product_id is not the same of product");
            $this->assertEquals($content[$index]['price'], $content[$index]['histories'][0]['price'], "the history price is not the same of product");
            $this->assertEquals(0, $content[$index]['histories'][0]['previous_balance'], "the first history previous_balance is not zero");
            $this->assertEquals($content[$index]['qtd'], $content[$index]['histories'][0]['movement'], "the first history movement is not qtd product");
            $this->assertEquals($content[$index]['qtd'], $content[$index]['histories'][0]['final_balance'], "the first history movement is not qtd product");
        }
    }

    public function testUpdateProduct()
    {
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

        $contentCreated = $response->json();

        $postUpdate = [
            [
                "id" => $contentCreated[0]['id'],
                "name" => "Notebook dell",
                "price" => 2000,
                "qtd" => 4,
                "unit" => "fix",
                "format" => "double"
            ]
        ];

        $response = $this->putJson('/api/products/update', $postUpdate);

        $content = $response->json();

        $this->assertEquals($postUpdate[0]['name'], $content[0]['name'], "The update not change name product");
        $this->assertEquals($postUpdate[0]['price'], $content[0]['price'], "The update not change price product");
        $this->assertNotEquals($postUpdate[0]['qtd'], $content[0]['qtd'], "The update change qtd product");
        $this->assertEquals($postUpdate[0]['unit'], $content[0]['unit'], "The update change unit product");
        $this->assertEquals($postUpdate[0]['format'], $content[0]['format'], "The update change format product");
    }

    public function testDeleteAndFindProduct()
    {
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

        $contentCreated = $response->json();

        $postDelete = [
            [
                "id" => $contentCreated[0]['id']
            ]
        ];

        $responseDelete = $this->deleteJson('/api/products/delete', $postDelete);

        $responseFind = $this->get("/api/products/find/{$postDelete[0]["id"]}");
        // 204 is status code for delete product
        $responseFind->assertStatus(204);
    }
}
