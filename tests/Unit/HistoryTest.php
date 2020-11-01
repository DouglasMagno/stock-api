<?php

namespace Tests\Unit;

use Tests\TestCase;

class HistoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        $response = $this->get('/api/history');
        $response->assertStatus(200);

        $content = $response->json();
        $this->assertIsArray($content, "Response of get all histories are not array response");

        if (is_array($content)){
            if (count($content)){
                $asserts = [
                    "id" => "assertIsInt",
                    "product_id" => "assertIsInt",
                    "price" => "assertIsInt",
                    "previous_balance" => "assertIsInt",
                    "movement" => "assertIsInt",
                    "final_balance" => "assertIsInt",
                    "created_at" => "assertIsString",
                    "updated_at" => "assertIsString",
                    "product_name" => "assertIsString"
                ];
                foreach ($asserts as $index => $assert) {
                    $this->assertArrayHasKey($index, $content[0], "Product does not have {$index} attribute");
                    $this->{$assert}($content[0][$index], "Product {$index} is cant {$assert}");
                }
            }
        }
    }
}
