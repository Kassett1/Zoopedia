<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Habitat;
use App\Entity\RegimeAlimentaire;
use App\Entity\Animal;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Catégories
        $categorie1 = new Categorie(
            'Mammifère',
            ''
        );

        $categorie2 = new Categorie(
            'Oiseau',
            ''
        );

        $categorie3 = new Categorie(
            'Reptile',
            ''
        );

        $categorie4 = new Categorie(
            'Poisson',
            ''
        );

        $categorie5 = new Categorie(
            'Insecte',
            ''
        );

        // Habitats
        $habitat1 = new Habitat(
            'Forêt',
            'Une forêt est une vaste étendue boisée, où les arbres prédominent.',
            'foret.jpg'
        );

        $habitat2 = new Habitat(
            'Savane',
            'Une savane est une formation herbeuse parsemée d\'arbres, typique des régions tropicales.',
            'savane.jpg'
        );

        $habitat3 = new Habitat(
            'Montagne',
            'Une montagne est une élévation naturelle de terrain d\'une hauteur supérieure à 500 mètres.',
            'montagne.jpg'
        );

        $habitat4 = new Habitat(
            'Rivière',
            '',
            'riviere.jpg'
        );

        $habitat5 = new Habitat(
            'Désert',
            'Un désert est un milieu naturel où les précipitations sont rares et les conditions de vie sont difficiles.',
            'desert.jpg'
        );

        $habitat6 = new Habitat(
            'Océan',
            'L\'océan est une vaste étendue d\'eau salée qui recouvre une grande partie de la surface de la Terre.',
            'ocean.jpg'
        );

        // Régimes alimentaires

        $regime1 = new RegimeAlimentaire(
            'Carnivore',
            'Les carnivores se nourrissent principalement de viande.'
        );

        $regime2 = new RegimeAlimentaire(
            'Herbivore',
            'Les herbivores se nourrissent principalement de végétaux.'
        );

        $regime3 = new RegimeAlimentaire(
            'Omnivore',
            ''
        );


        // Animaux
        $animal1 = new Animal(
            'Lion',
            'Le lion est un mammifère carnivore de la famille des félidés.',
            'lion.jpg',
            $habitat2,
            $regime1,
            $categorie1
        );

        $animal2 = new Animal(
            'Girafe',
            'La girafe est un mammifère herbivore de la famille des girafidés.',
            'girafe.jpg',
            $habitat2,
            $regime2,
            $categorie1
        );

        $animal3 = new Animal(
            'Tigre',
            'Le tigre est un mammifère carnivore de la famille des félidés.',
            'tigre.jpg',
            $habitat2,
            $regime1,
            $categorie1
        );

        $animal4 = new Animal(
            'Éléphant',
            'L\'éléphant est un mammifère herbivore de la famille des éléphantidés.',
            'elephant.jpg',
            $habitat2,
            $regime2,
            $categorie1
        );

        $animal5 = new Animal(
            'Perroquet',
            'Le perroquet est un oiseau connu pour sa capacité à imiter les sons et les paroles.',
            'perroquet.jpg',
            $habitat2,
            $regime2,
            $categorie2
        );

        $animal6 = new Animal(
            'Python',
            'Le python est un reptile de grande taille de la famille des serpents.',
            'python.jpg',
            $habitat3,
            $regime1,
            $categorie3
        );

        $animal7 = new Animal(
            'Poisson-clown',
            'Le poisson-clown est un petit poisson coloré vivant dans les récifs coralliens.',
            'poisson-clown.jpg',
            $habitat6,
            $regime2,
            $categorie4
        );

        $animal8 = new Animal(
            'Léopard',
            'Le léopard est un mammifère carnivore de la famille des félidés.',
            'leopard.jpg',
            $habitat2,
            $regime1,
            $categorie1
        );

        $animal9 = new Animal(
            'Panda',
            'Le panda est un mammifère herbivore de la famille des ursidés.',
            'panda.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal10 = new Animal(
            'Aigle',
            'L\'aigle est un oiseau de proie réputé pour sa vue perçante et sa grande envergure.',
            'aigle.jpg',
            $habitat3,
            $regime1,
            $categorie2
        );

        $animal11 = new Animal(
            'Crocodile',
            'Le crocodile est un grand reptile aquatique à la mâchoire puissante.',
            'crocodile.jpg',
            $habitat4,
            $regime1,
            $categorie3
        );

        $animal12 = new Animal(
            'Requin',
            'Le requin est un poisson prédateur des océans, caractérisé par ses nageoires et sa dentition acérée.',
            'requin.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );

        $animal13 = new Animal(
            'Scarabée',
            'Le scarabée est un insecte connu pour son exosquelette solide et ses antennes caractéristiques.',
            'scarabee.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );


        $animal14 = new Animal(
            'Ours polaire',
            'L\'ours polaire est un grand mammifère carnivore adapté à la vie dans les régions arctiques.',
            'ours_polaire.jpg',
            $habitat1,
            $regime1,
            $categorie1
        );

        $animal15 = new Animal(
            'Pingouin',
            'Le pingouin est un oiseau marin adapté à la vie en milieu polaire.',
            'pingouin.jpg',
            $habitat6,
            $regime2,
            $categorie2
        );

        $animal16 = new Animal(
            'Serpent à sonnette',
            'Le serpent à sonnette est un reptile venimeux reconnaissable par sa queue à sonnettes.',
            'serpent_sonnette.jpg',
            $habitat5,
            $regime1,
            $categorie3
        );

        $animal17 = new Animal(
            'Piranha',
            'Le piranha est un poisson carnivore d\'eau douce vivant principalement en Amérique du Sud.',
            'piranha.jpg',
            $habitat4,
            $regime1,
            $categorie4
        );

        $animal18 = new Animal(
            'Papillon',
            'Le papillon est un insecte volant caractérisé par ses ailes colorées et délicates.',
            'papillon.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );

        $animal19 = new Animal(
            'Koala',
            'Le koala est un marsupial herbivore natif d\'Australie, connu pour sa tendresse envers les arbres d\'eucalyptus.',
            'koala.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal20 = new Animal(
            'Autruche',
            'L\'autruche est un grand oiseau terrestre qui ne vole pas mais peut courir à grande vitesse.',
            'autruche.jpg',
            $habitat2,
            $regime2,
            $categorie2
        );

        $animal21 = new Animal(
            'Ours',
            "L'ours brun, avec sa force et sa fourrure épaisse, est un mammifère omnivore qui évolue avec aisance dans divers habitats, allant des forêts aux montagnes.",
            'ours.jpg',
            $habitat1,
            $regime3,
            $categorie1
        );

        $animal22 = new Animal(
            'Poisson rouge',
            'Le poisson rouge est un poisson d\'eau douce populaire en aquariophilie.',
            'poisson_rouge.jpg',
            $habitat4,
            $regime2,
            $categorie4
        );

        $animal23 = new Animal(
            'Fourmi',
            'La fourmi est un insecte social, connu pour sa capacité à travailler en collaboration avec d\'autres fourmis.',
            'fourmi.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );

        $animal24 = new Animal(
            'Kangourou',
            'Le kangourou est un marsupial connu pour sa capacité à sauter sur de longues distances.',
            'kangourou.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal25 = new Animal(
            'Chouette',
            'La chouette est un oiseau nocturne reconnu pour sa vision et son vol silencieux.',
            'chouette.jpg',
            $habitat3,
            $regime1,
            $categorie2
        );

        $animal26 = new Animal(
            'Caméléon',
            'Le caméléon est un reptile connu pour sa capacité à changer de couleur pour se camoufler.',
            'cameleon.jpg',
            $habitat3,
            $regime1,
            $categorie3
        );

        $animal27 = new Animal(
            'Requin-marteau',
            'Le requin-marteau est un grand requin reconnaissable par sa tête en forme de marteau.',
            'requin_marteau.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );

        $animal28 = new Animal(
            'Coccinelle',
            'La coccinelle est un petit insecte volant souvent associé à la chance.',
            'coccinelle.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );

        $animal29 = new Animal(
            'Singe',
            'Le singe est un mammifère intelligent et agile, souvent associé à la jungle et à la forêt.',
            'singe.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal30 = new Animal(
            'Araignée',
            'L\'araignée est un arachnide présent dans une grande variété d\'habitats.',
            'araignee.jpg',
            $habitat5,
            $regime1,
            $categorie5
        );

        $animal31 = new Animal(
            'Dauphin',
            'Le dauphin est un mammifère marin intelligent et sociable, connu pour ses acrobaties.',
            'dauphin.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );

        $animal32 = new Animal(
            'Tortue',
            'La tortue est un reptile doté d\'une carapace protectrice.',
            'tortue.jpg',
            $habitat4,
            $regime2,
            $categorie3
        );

        $animal33 = new Animal(
            'Cheval',
            'Le cheval est un grand mammifère herbivore, domestiqué par l\'homme depuis des milliers d\'années.',
            'cheval.jpg',
            $habitat2,
            $regime2,
            $categorie1
        );

        $animal34 = new Animal(
            'Paon',
            'Le paon est un oiseau connu pour son plumage coloré et sa parade nuptiale spectaculaire.',
            'paon.jpg',
            $habitat2,
            $regime2,
            $categorie2
        );

        $animal35 = new Animal(
            'Gecko',
            'Le gecko est un petit lézard présent dans de nombreux habitats tropicaux.',
            'gecko.jpg',
            $habitat3,
            $regime1,
            $categorie3
        );

        $animal36 = new Animal(
            'Méduse',
            'La méduse est un animal marin gélatineux qui flotte dans l\'eau.',
            'meduse.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );

        $animal37 = new Animal(
            'Papillon de nuit',
            'Le papillon de nuit est un insecte volant nocturne souvent attiré par la lumière.',
            'papillon_nuit.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );

        $animal38 = new Animal(
            'Panthère',
            'La panthère est un grand félin noir tacheté, connu pour sa grâce et sa puissance.',
            'panthere.jpg',
            $habitat2,
            $regime1,
            $categorie1
        );

        $animal39 = new Animal(
            'Kangourou',
            'Le kangourou est un marsupial sauteur originaire d\'Australie.',
            'kangourou.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal40 = new Animal(
            'Corbeau',
            'Le corbeau est un oiseau intelligent et opportuniste, souvent associé à la sorcellerie.',
            'corbeau.jpg',
            $habitat2,
            $regime2,
            $categorie2
        );

        $animal41 = new Animal(
            'Boa constrictor',
            'Le boa constrictor est un grand serpent non venimeux qui serre ses proies pour les étouffer.',
            'boa_constrictor.jpg',
            $habitat3,
            $regime1,
            $categorie3
        );

        $animal42 = new Animal(
            'Raie manta',
            'La raie manta est un grand poisson marin connu pour son apparence majestueuse.',
            'raie_manta.jpg',
            $habitat6,
            $regime2,
            $categorie4
        );

        $animal43 = new Animal(
            'Lucane cerf-volant',
            'Le lucane cerf-volant est un gros coléoptère aux mandibules impressionnantes.',
            'lucane_cerf_volant.jpg',
            $habitat5,
            $regime2,
            $categorie5
        );

        $animal44 = new Animal(
            'Chimpanzé',
            'Le chimpanzé est un grand singe intelligent et sociable, génétiquement proche de l\'homme.',
            'chimpanze.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal45 = new Animal(
            'Faucon',
            'Le faucon est un rapace diurne connu pour sa vitesse de vol et sa vision perçante.',
            'faucon.jpg',
            $habitat3,
            $regime1,
            $categorie2
        );

        $animal46 = new Animal(
            'Baleine',
            'La baleine, géant des océans, nage gracieusement et se nourrit de plancton et de petits poissons.',
            'baleine.jpg',
            $habitat6,
            $regime2,
            $categorie1
        );

        $animal47 = new Animal(
            'Méduse lune',
            'La méduse lune est une espèce de méduse translucide en forme de disque.',
            'meduse_lune.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );

        $animal48 = new Animal(
            'Cafard',
            'Le cafard est un insecte nocturne et résistant souvent considéré comme une nuisance.',
            'cafard.jpg',
            $habitat5,
            $regime1,
            $categorie5
        );

        $animal49 = new Animal(
            'Gorille',
            'Le gorille est le plus grand des primates, connu pour sa force et son comportement social.',
            'gorille.jpg',
            $habitat1,
            $regime2,
            $categorie1
        );

        $animal50 = new Animal(
            'Pieuvre',
            'La pieuvre est un céphalopode marin aux tentacules souples et à l\'intelligence surprenante.',
            'pieuvre.jpg',
            $habitat6,
            $regime1,
            $categorie4
        );




        // Persistance des données
        for ($i = 1; $i <= 5; $i++) {
            $entityName = "categorie" . $i;
            $manager->persist($$entityName);
        }

        for ($i = 1; $i <= 6; $i++) {
            $entityName = "habitat" . $i;
            $manager->persist($$entityName);
        }

        for ($i = 1; $i <= 3; $i++) {
            $entityName = "regime" . $i;
            $manager->persist($$entityName);
        }

        for ($i = 1; $i <= 50; $i++) {
            $entityName = "animal" . $i;
            $manager->persist($$entityName);
        }

        $manager->flush();
    }
}
