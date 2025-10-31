 <section id="projects">
     <h2 class="text-3xl sm:text-4xl font-heading font-bold text-zinc-900 dark:text-white mb-12">
         Projects</h2>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

         @foreach ($portfolio->projects as $project)
             <div
                 class="group flex flex-col bg-zinc-100/50 dark:bg-zinc-900/50 rounded-xl overflow-hidden transition-all hover:shadow-2xl hover:shadow-magenta/20">
                 @if ($project->thumbnail_path)
                     <div class="overflow-hidden">
                         <div class="bg-center bg-no-repeat aspect-video bg-cover transition-transform duration-500 group-hover:scale-105"
                             data-alt="Thumbnail for Project Phoenix, showing a dashboard UI."
                             style='background-image: url("{{ Storage::url($project->thumbnail_path) }}");'>
                         </div>
                     </div>
                 @endif
                 <div class="p-6 flex flex-col flex-grow">
                     <h3 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $project->title }}</h3>
                     <p class="mt-2 text-base flex-grow">{{ $project->brief_description }}</p>
                      <div class="flex items-center gap-2">
                    @foreach ($project->skills as $skill)
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-zinc-200/50 dark:bg-zinc-800/50 hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors"
                        >
                            {!! $skill->logo !!}
                        </div>
                    @endforeach

                </div>
                     @if ($project->project_link)
                         <a href="{{ $project->project_link }}"
                             class="mt-6 flex w-fit items-center justify-center rounded-lg h-10 px-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 text-sm font-bold leading-normal group-hover:bg-magenta group-hover:text-white transition-colors">
                             <span class="truncate">View Project</span>
                         </a>
                     @endif
                 </div>
             </div>
         @endforeach

     </div>
 </section>
