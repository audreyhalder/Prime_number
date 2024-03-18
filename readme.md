# Prime Number Finder

I will make the an application with the Symfony framework. I will allow users to find **Prime Numbers** within a given range.

---

### Summary of Symfony component`s to be used

- `composer require symfony/maker-bundle symfony/twig-bundle`
- `composer require symfony/form`

### Summary of Console command`s to be used

- php bin/console make:controller PrimeNumberController
- php bin/console make:form PrimeNumberFormType
- ./vendor/bin/phpunit (In order to run unit test)

---

### 1.Project Configuration

---

1. Run the following command in the project's root directory:

```bash
composer update
```

2. Now, run the server:

```bash
 symfony server:start
```

3. Access to [http://localhost:8000/](http://localhost:8000/) to view the result.

---

### 2.PrimeNumberController

---

[/src/Controller/PrimeNumberController.php](./src/Controller/PrimeNumberController.php)\_

```php
<?php

namespace App\Controller;

use App\Form\Formtype;
use App\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PrimeNumberController extends AbstractController
{
    #[Route('/primenumber', name: 'app_prime_number')]
    public function index(Request $request,Service $service): Response
    {
        $form = $this->createForm(formType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $data = $form->getData();
        $primenumbers = $service->prime($data['first'],$data['second']);
        #dd($primenumbers);
        
       
        return $this->render('prime_number/output.html.twig', [
            'prime_numbers' => $primenumbers,
        ]);
    }
        return $this->render('prime_number/index.html.twig', [
            'form' => $form,
        ]);
    }
}

```

---

### 3.FormType

---

[/src/Form/FormType.php](./src/Form/FormType.php)\_

```php
<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first',TextType::class,[
                'label' => 'First integer',
                'attr' => [
                    'placeholder' => 'int'
                ]
            ])
            ->add('second',TextType::class,[
                'label' => 'Second integer',
                'attr' => [
                    'placeholder' => 'int'
                ]
            ])
            ->add('save',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary mt-2'
                ]
            ])
        ;
    }  
}
```

---

### 4.Creating a Prime-Number Service

---

_[src/Service/Service.php](./src/Service/Service.php)_

```php
<?php

namespace App\Service;

class Service
{
    public function prime(int $first, int $second) : array
    {
        if($first> $second){
            $temp = $first;
            $start = $second;
            $end = $temp;
        }else{
            $start = $first;
            $end = $second;
        }

        $primes = [];

        for($i=$start;$i<=$end;$i++){
            if($this->isItPrime($i)){
                $primes[] = $i;
            }

        }

        return $primes;
    }

    private function isItprime(int $integer): bool
    {
        if($integer<2){
            return false;
        }
        for($i=2;$i<=sqrt($integer);$i++){
            if($integer%$i == 0){
                return false;
            }

        }

        return true;
    }
}
```

---

### 5.Creating a Unit Test

---

_[tests/Service/PrimeNumberServiceTest.php](.tests/Service/PrimeNumberServiceTest.php)_

```php
<?php

namespace App\Tests\Service;

use App\Service\Service;
use PHPUnit\Framework\TestCase;

class PrimeNumberServiceTest extends TestCase{
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new Service();
    }
    public function testGetPrimeNumbersWithValidRange()
    {
        
        $primeNumbers = $this->service->prime(1, 20);
        $expectedPrimeNumbers = [2, 3, 5, 7, 11, 13, 17, 19];
        $this->assertEquals($expectedPrimeNumbers, $primeNumbers);
    }
}
```