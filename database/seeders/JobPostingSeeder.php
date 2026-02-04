<?php

namespace Database\Seeders;

use App\Models\JobPosting;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Administrateur Réseau',
                'status' => 'en_cours',
                'type' => 'CDD',
                'description' => 'Sous l\'autorité du Field Sales Manager, l\'administrateur réseau sera chargé de la gestion et de la maintenance de l\'infrastructure réseau de l\'entreprise.',
                'attributions' => [
                    'Centralisation des ventes',
                    'Suivi journalier des ventes',
                    'Renseignement et mise à jour des tableaux de bord',
                    'Production des données statistiques'
                ],
                'competences' => 'Maîtrise du pack office (Niveau avancé en Excel)',
                'diplome' => 'Licence ou tout autre diplôme équivalent',
                'experience' => '03 ans à un poste similaire',
                'aptitudes' => [
                    'Être très organisé',
                    'Esprit cartésien',
                    'Travail en équipe',
                    'Connaissances en comptabilité'
                ],
                'pieces_required' => [
                    'Lettre de motivation',
                    'CV',
                    'Copie des diplômes',
                    'Copie de la pièce d\'identité'
                ],
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Assistant(e) Administratif(ve)',
                'status' => 'en_cours',
                'type' => 'CDI',
                'description' => 'Nous recherchons un(e) assistant(e) administratif(ve) dynamique pour rejoindre notre équipe. Vous serez en charge du support administratif et de la coordination des activités quotidiennes.',
                'attributions' => [
                    'Gestion du courrier et des appels téléphoniques',
                    'Organisation des réunions et rédaction des comptes rendus',
                    'Classement et archivage des documents',
                    'Suivi des dossiers administratifs'
                ],
                'competences' => 'Maîtrise du pack Microsoft Office, Excellentes capacités rédactionnelles',
                'diplome' => 'BTS Assistanat de Direction ou équivalent',
                'experience' => '02 ans minimum dans un poste similaire',
                'aptitudes' => [
                    'Rigueur et organisation',
                    'Sens de la communication',
                    'Discrétion professionnelle',
                    'Polyvalence'
                ],
                'pieces_required' => [
                    'CV actualisé',
                    'Lettre de motivation manuscrite',
                    'Copies certifiées des diplômes',
                    'Attestations de travail'
                ],
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Développeur Full Stack',
                'status' => 'en_cours',
                'type' => 'CDI',
                'description' => 'Cabinet de conseil recherche un développeur Full Stack pour concevoir et développer des applications web innovantes pour nos clients.',
                'attributions' => [
                    'Conception et développement d\'applications web',
                    'Maintenance et optimisation du code existant',
                    'Collaboration avec l\'équipe design et produit',
                    'Participation aux revues de code'
                ],
                'competences' => 'PHP/Laravel, JavaScript/Vue.js, MySQL, Git',
                'diplome' => 'Master en Informatique ou équivalent',
                'experience' => '04 ans d\'expérience en développement web',
                'aptitudes' => [
                    'Autonomie et proactivité',
                    'Esprit d\'équipe',
                    'Veille technologique',
                    'Résolution de problèmes'
                ],
                'pieces_required' => [
                    'CV détaillé',
                    'Portfolio de projets',
                    'Lettre de motivation',
                    'Diplômes'
                ],
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Comptable',
                'status' => 'en_cours',
                'type' => 'CDD',
                'description' => 'Recherche comptable expérimenté pour assurer la gestion comptable et financière de l\'entreprise.',
                'attributions' => [
                    'Tenue de la comptabilité générale',
                    'Établissement des situations comptables',
                    'Préparation des déclarations fiscales',
                    'Gestion de la trésorerie'
                ],
                'competences' => 'Maîtrise des logiciels comptables (SAGE, SAP), Excel avancé',
                'diplome' => 'Licence en Comptabilité et Gestion',
                'experience' => '05 ans minimum en cabinet comptable',
                'aptitudes' => [
                    'Rigueur et précision',
                    'Respect des délais',
                    'Sens de l\'analyse',
                    'Confidentialité'
                ],
                'pieces_required' => [
                    'CV',
                    'Lettre de motivation',
                    'Copies des diplômes',
                    'Références professionnelles'
                ],
                'published_at' => Carbon::now()->subWeek(),
            ],
            [
                'title' => 'Chef de Projet Digital',
                'status' => 'en_cours',
                'type' => 'CDI',
                'description' => 'Nous recherchons un Chef de Projet Digital passionné pour piloter nos projets de transformation numérique.',
                'attributions' => [
                    'Pilotage de projets digitaux de A à Z',
                    'Coordination des équipes techniques et créatives',
                    'Gestion du budget et des plannings',
                    'Reporting auprès de la direction'
                ],
                'competences' => 'Méthodologies Agile/Scrum, Gestion de projet, Outils digitaux',
                'diplome' => 'Master en Management ou Digital',
                'experience' => '03 ans en gestion de projets digitaux',
                'aptitudes' => [
                    'Leadership',
                    'Excellent relationnel',
                    'Gestion du stress',
                    'Innovation'
                ],
                'pieces_required' => [
                    'CV',
                    'Lettre de motivation',
                    'Portfolio de projets menés',
                    'Diplômes'
                ],
                'published_at' => Carbon::now()->subDays(20),
            ],
            [
                'title' => 'Commercial Terrain',
                'status' => 'en_cours',
                'type' => 'CDI',
                'description' => 'Rejoignez notre équipe commerciale dynamique en tant que Commercial Terrain pour développer notre portefeuille clients.',
                'attributions' => [
                    'Prospection et développement clientèle',
                    'Négociation commerciale',
                    'Suivi et fidélisation des clients',
                    'Reporting des activités commerciales'
                ],
                'competences' => 'Techniques de vente, Négociation, CRM',
                'diplome' => 'Bac+2 en Commerce ou équivalent',
                'experience' => '02 ans d\'expérience commerciale',
                'aptitudes' => [
                    'Excellent relationnel',
                    'Persévérance',
                    'Mobilité',
                    'Esprit de compétition'
                ],
                'pieces_required' => [
                    'CV',
                    'Lettre de motivation',
                    'Permis de conduire',
                    'Certificats de travail'
                ],
                'published_at' => Carbon::now()->subDays(35),
            ],
            [
                'title' => 'Responsable Ressources Humaines',
                'status' => 'cloture',
                'type' => 'CDI',
                'description' => 'Poste de Responsable RH pour gérer l\'ensemble des processus RH de l\'entreprise.',
                'attributions' => [
                    'Gestion du recrutement',
                    'Administration du personnel',
                    'Gestion de la paie',
                    'Développement des compétences'
                ],
                'competences' => 'Droit du travail, Gestion de la paie, SIRH',
                'diplome' => 'Master en Ressources Humaines',
                'experience' => '05 ans en tant que RRH',
                'aptitudes' => [
                    'Écoute et empathie',
                    'Confidentialité',
                    'Gestion de conflits',
                    'Management'
                ],
                'pieces_required' => [
                    'CV',
                    'Lettre de motivation',
                    'Diplômes',
                    'Attestations'
                ],
                'published_at' => Carbon::now()->subDays(50),
            ],
            [
                'title' => 'Stagiaire Marketing Digital',
                'status' => 'en_cours',
                'type' => 'Stage',
                'description' => 'Opportunité de stage en Marketing Digital pour un étudiant motivé souhaitant acquérir une expérience pratique.',
                'attributions' => [
                    'Gestion des réseaux sociaux',
                    'Création de contenu web',
                    'Analyse des performances marketing',
                    'Support aux campagnes publicitaires'
                ],
                'competences' => 'Réseaux sociaux, Google Analytics, Canva, suite Adobe',
                'diplome' => 'Bac+3/4 en Marketing Digital',
                'experience' => 'Débutant accepté',
                'aptitudes' => [
                    'Créativité',
                    'Curiosité',
                    'Autonomie',
                    'Maîtrise des outils digitaux'
                ],
                'pieces_required' => [
                    'CV',
                    'Lettre de motivation',
                    'Convention de stage',
                    'Attestation de scolarité'
                ],
                'published_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($jobs as $jobData) {
            JobPosting::create($jobData);
        }
    }
}
