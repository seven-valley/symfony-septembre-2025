

# Entity product
```php
// src/Entity/Product.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type:"text", nullable:true)]
    private ?string $description = null;

    // getters / setters
}
```

# GET Afficher les produits

```php
// src/Controller/ApiProductController.php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiProductController extends AbstractController
{
    #[Route('/api/products', methods:['GET'])]
    public function list(ProductRepository $repo): JsonResponse
    {
        $products = $repo->findAll();
        
        return new JsonResponse("$products");
    }
}
```

# POST
```php

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

#[Route('/api/products', methods:['POST'])]
public function create(
    Request $request,
    EntityManagerInterface $em
): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    $product = new Product();
    $product->setName($data['name']);
    $product->setPrice($data['price']);
    $product->setDescription($data['description']);

    $em->persist($product);
    $em->flush();

    return new JsonResponse([
        'status' => 'product created'
    ]);
}
```
