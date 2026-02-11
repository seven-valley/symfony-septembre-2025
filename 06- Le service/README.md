# refactoring

```php
// src/Controller/OrderController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order/total')]
    public function total(): Response
    {
        $items = [
            ['price' => 100, 'qty' => 2],
            ['price' => 50, 'qty' => 1],
        ];

        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['qty'];
        }

        if ($total > 200) {
            $total = $total * 0.9; // remise 10%
        }

        return new Response("Total commande : $total €");
    }
}

```

```php
<?php

namespace App\Service;

class OrderCalculator
{
    public function calculate(array $items): float
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return $this->applyDiscount($total);
    }

    private function applyDiscount(float $total): float
    {
        return $total > 200 ? $total * 0.9 : $total;
    }
}
```

```php
// src/Controller/OrderController.php
namespace App\Controller;

use App\Service\OrderCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function __construct(
        private OrderCalculator $orderCalculator
    ) {}

    #[Route('/order/total')]
    public function total(): Response
    {
        $items = [
            ['price' => 100, 'qty' => 2],
            ['price' => 50, 'qty' => 1],
        ];

        $total = $this->orderCalculator->calculate($items);

        return new Response("Total commande : $total €");
    }
}
```