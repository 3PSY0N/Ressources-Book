<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private ObjectManager $manager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $user = $this->createUser();

        for ($c = 0; $c < 3; $c++) {
            $category = $this->createCategory();

            for ($a = 0; $a < 5; $a++) {
                $this->createArticle($user, $category);
            }
        }

        $manager->flush();
    }

    public function createUser(): User
    {
        $user = new User();
        $user
            ->setEmail('john@doe.com')
            ->setDisplayName('John Doe')
            ->setPassword($this->passwordEncoder->encodePassword($user, 'jdoe'))
            ->setRoles(['ROLE_USER']);

        $this->manager->persist($user);

        return $user;
    }

    public function createCategory(): Category
    {
        $faker = Factory::create();

        $category = new Category();
        $category->setName($faker->word);
        $this->manager->persist($category);

        return $category;
    }

    public function createArticle(User $user, Category $category): Article
    {
        $faker = Factory::create();

        $article = new Article();
        $article
            ->setUser($user)
            ->setContent($faker->text)
            ->setTitle($faker->title)
            ->addCategory($category);

        $this->manager->persist($article);

        return $article;
    }
}
