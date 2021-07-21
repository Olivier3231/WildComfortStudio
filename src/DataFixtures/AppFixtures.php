<?php

namespace App\DataFixtures;

use App\Entity\About;
use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Coach;
use App\Entity\ImageUpload;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $slugger;

    public function __construct(Slugify $slugify){
        $this->slugger = $slugify;
    }
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // About
        $about = new About();
        $about->setTitle('Wild Comfort Studio')
        ->setSubTitle('Mon Corps de A à Z')
        ->setAdress('36 rue du bien-être 32000 Lebonheuretdanslegers')
        ->setEmail('maffrolivier74@gmail.com')
        ->setPhone('06-54-65-89-13')
        ->setLegalMention('')
        ->setTimetable('6h - 22h 7j/7');

        $manager->persist($about);
        // Coach
        $x=0;
        $coachPersist = [];
        for ($i=0; $i < 5; $i++){
            $coach =new Coach();
            $coach->setName($faker->firstName(1))
            ->setDescription($faker->paragraph(2));
        
            $manager->persist($coach);
            $coachPersist[] = $coach;
            
        }
        //Category
        $categories = ['Sport', 'Bien-être', 'Soins'];
         $categoriesPersist = [];
         foreach ($categories as $category) {
             $new1 = new Category();
             $new1->setName($category);

             $manager->persist($new1);
             $categoriesPersist[] = $new1;
         }
         //Illustration
         $imagePersist = [];
         for ($i = 0; $i < 10; $i++) {
            $image = new ImageUpload();
            $image->setImage("https://picsum.photos/id/103/500/300");

            $manager->persist($image);
            $imagePersist[] = $image;
         }
        

        //Activity
        $activities = ['Musculation', 'Yoga', 'Massage', 'Nutrition', 'Pilates', 'Zumba', 'Sophrologie', 'Shiatsu'];
        $activitiesPersist = [];
        foreach ($activities as $activity) {
            $new = new Activity();
            $new->setName($activity)
            ->setSlug($this->slugger->generate($new->getName()))
            ->setDescription($faker->paragraph(5))
            ->setRate($faker->randomNumber(2, true))
            ->addCoach($faker->randomElement($coachPersist))
            ->setCategory($faker->randomElement($categoriesPersist))
            ->setTimetable($faker->dayOfWeek(), $faker->time('H'))
            ->addIllustration($faker->randomElement($imagePersist));
            
            
            $manager->persist($new);
            $activitiesPersist[] = $new;

        }
        //User
        $manager->flush();
    }
}
