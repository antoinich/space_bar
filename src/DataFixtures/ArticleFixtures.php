<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture implements DependentFixtureInterface
{

    private static $articleTitles = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy',
    ];
    private static $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];
    private static $articleAuthors = [
        'Mike Ferengi',
        'Amy Oort',
    ];

    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(Article::class, 10, function ($article, $count) use ($manager) {

        $article->setTitle($this->faker->randomElement(self::$articleTitles))
            ->setContent(<<<EOF
Laboris beef ribs fatback fugiat eiusmod jowl **kielbasa** alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong [frankfurter boudin] (https://baconipsum.com/) cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
                        
**Meatball** adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
Sausage tenderloin officia jerky nostrud. Laborum elit pastrami non, pig kevin buffalo minim ex quis. Pork belly
pork chop officia anim. Irure tempor leberkas kevin adipisicing cupidatat qui buffalo ham aliqua pork belly
exercitation eiusmod. Exercitation incididunt rump laborum, t-bone short ribs buffalo ut shankle pork chop
bresaola shoulder burgdoggen fugiat. Adipisicing nostrud chicken consequat beef ribs, quis filet mignon do.
Prosciutto capicola mollit shankle aliquip do dolore hamburger brisket turducken eu.
EOF
            )
        ;

        if ($this->faker->boolean(70)) {
            $article->setPublishedAt($this->faker->dateTimeBetween('-100 days' , '-1 days'));
        }

        $article->setAuthor($this->faker->randomElement(self::$articleAuthors))
            ->setHeartCount($this->faker->numberBetween(5, 100))
            ->setImageFilename($this->faker->randomElement(self::$articleImages));

        /**@var Tag[] $tags */
        $tags = $this->getRandomReferences(Tag::class, $this->faker->numberBetween(0, 5));
        foreach ($tags as $tag) {
            $article->addTag($tag);
        }


    });
        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            TagFixture::class,
        ];
    }

}