<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\Portfolio;
use App\Models\About;
use App\Models\Experience;
use App\Models\EducationRecord;
use App\Models\Project;
use App\Models\Skill;
use App\Models\PortfolioContactMethod;
use App\Models\ContactMethod;
use App\Models\PortfolioSkill;
use App\Enums\SkillType;

class TemplateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Template $template)
    {
        // Demo data for template preview
        $portfolio = new Portfolio([
            'uid' => 'demo-portfolio-123',
            'title' => 'Demo Portfolio',
            'slug' => 'demo',
            'theme' => 'dark',
            'accept_messages' => true,
        ]);

        // About section
        $about = new About([
            'portfolio_id' => 1,
            'name' => 'John Doe',
            'brief' => 'Full Stack Developer',
            'description' => 'I\'m a passionate developer with 5+ years of experience building web applications. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio nisi ea fugiat assumenda vero cumque exercitationem sapiente voluptates non soluta expedita, deserunt ullam porro aliquam unde officiis nulla tenetur quo quisquam doloribus dolor? Illo quod excepturi repellat consequuntur, fugiat ipsum adipisci accusamus libero possimus! Eos unde corrupti libero amet repudiandae, vero itaque vitae minus sit, quisquam consectetur dignissimos ea sed cupiditate veritatis aspernatur nemo velit maxime temporibus. Nulla voluptas porro rerum corrupti nisi ipsa consectetur aspernatur non ducimus et ipsum sint, repudiandae iste. Eveniet, veritatis provident! Magni sunt nobis, molestias vitae aperiam, ab odio iusto id quas, sint voluptates eaque?',
            'logo' => 'portfolios\demo\pfp.jpg',
            'years_of_experience' => 5,
            'total_projects_done' => 50,
        ]);
        $portfolio->setRelation('about', $about);

        // Section orders for demo
        $sectionOrders = collect([
            (object)['section_id' => 'about', 'position' => 1],
            (object)['section_id' => 'experience', 'position' => 2],
            (object)['section_id' => 'education', 'position' => 3],
            (object)['section_id' => 'skills', 'position' => 4],
            (object)['section_id' => 'projects', 'position' => 5],
        ]);
        $portfolio->setRelation('sectionOrders', $sectionOrders);

        // Experiences
        $experiences = collect([
            new Experience([
                'portfolio_id' => 1,
                'company' => 'Tech Corp',
                'position' => 'Senior Developer',
                'start_date' => '12/2020',
                'end_date' => null,
                'description' => 'Leading a team of developers on innovative projects.',
            ]),
            new Experience([
                'portfolio_id' => 1,
                'company' => 'StartUp Inc',
                'position' => 'Full Stack Developer',
                'start_date' => '12/2020',
                'end_date' => '05/2021',
                'description' => 'Developed and maintained multiple web applications.',
            ]),
        ]);
        $portfolio->setRelation('experiences', $experiences);

        // Education records
        $educationRecords = collect([
            new EducationRecord([
                'portfolio_id' => 1,
                'school' => 'University of Technology',
                'degree' => 'Bachelor of Science',
                'year_of_admission' => '12/2020',
                'year_of_graduation' => '12/2023',
            ]),
        ]);
        $portfolio->setRelation('educationRecords', $educationRecords);

        // Skills from database
        $skills = Skill::whereIn('id', [1, 2, 3, 4, 113, 114, 115])->get();
        $portfolio->setRelation('skills', $skills);

        // Projects
        $projects = collect([
            new Project([
                'portfolio_id' => 1,
                'title' => 'E-Commerce Platform',
                'brief_description' => 'Full-featured e-commerce platform built with Laravel and Vue.js',
                'project_link' => config('app.url'),
                'thumbnail_path' => 'portfolios\demo\1.jpg',
            ]),
            new Project([
                'portfolio_id' => 1,
                'title' => 'Task Management App',
                'brief_description' => 'Collaborative task management application',
                'project_link' => config('app.url'),
                'thumbnail_path' => 'portfolios\demo\1.jpg',
            ]),
        ]);

        $portfolio->setRelation('projects', $projects);

        // Contact methods
        $contactMethods = collect([
            new PortfolioContactMethod([
                'portfolio_id' => 1,
                'contact_method_id' => 1,
                'value' => 'john@example.com',

            ]),
            new PortfolioContactMethod([
                'portfolio_id' => 1,
                'contact_method_id' => 2,
                'value' => 'https://linkedin.com/in/johndoe',

            ]),
            new PortfolioContactMethod([
                'portfolio_id' => 1,
                'contact_method_id' => 3,
                'value' => 'https://github.com/johndoe',

            ]),
        ]);
        $portfolio->setRelation('contactMethods', $contactMethods);

        $years_of_experience = 5;

        return view($template->file_path . '.index', compact('portfolio', 'years_of_experience'));
    }
}
