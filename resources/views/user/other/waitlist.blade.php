<x-layouts.guest>
        <main
          class="flex flex-1 items-center justify-center py-10 px-4 sm:px-6 lg:px-8"
        >
          <div
            class="layout-content-container flex w-full max-w-2xl flex-col items-center"
          >
            <!-- Card Container -->
            <div
              class="w-full bg-card dark:bg-card-dark rounded-xl p-8 sm:p-12 text-center flex flex-col items-center"
            >
              <!-- Flat Illustration -->
              <div
                class="flex w-full max-w-xs grow bg-card dark:bg-card-dark @container pb-6"
              >
                <div
                  class="w-full gap-1 overflow-hidden bg-card dark:bg-card-dark @[480px]:gap-2 aspect-[4/3] flex"
                >
                  <div
                    class="w-full bg-center bg-no-repeat bg-cover aspect-auto flex-1"
                    data-alt="Abstract flat illustration of geometric shapes in soft colors, representing creativity and connection."
                    style="
                      background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBoZAWVnIqLdqDMJgULQUCPmtvcxisO3bxSLAFi5YsdM3iSNmcTRZi-p14xah_L356QrpKg-iuSOvgQECqyaEmzizKUSOGjVK-e7frg0v6JW6qWgNDfnwhw67Wo3CD64J_Cy0eD5ABfUnpIHdJ3IXwm6qEiq6_XiVQqytOR0Sl3FmdMzdIJrMMeP-MkLcU2w15gvi8Mbrwc_yvx_ROrk7tUwwOrhAlbJgf3mavCybSniR1XO_6YrxAexL0yOmhFU61IS0L7RGM5WCg');
                    "
                  ></div>
                </div>
              </div>
              <!-- Headline Text -->
              <h1
                class="text-text-primary-light dark:text-text-primary-dark tracking-tight text-3xl sm:text-4xl font-bold leading-tight pb-4"
              >
                Thank You for Joining the Waitlist!
              </h1>
              <!-- Body Text -->
              <p
                class="text-text-primary-light dark:text-text-primary-dark text-base font-normal leading-relaxed max-w-md pb-6"
              >
                Your spot is confirmed. We're excited to share {{config('app.name')}} with you soon
                and can't wait to see what you create.
              </p>
              <!-- Meta Text -->
              <p
                class="text-text-secondary-light dark:text-text-secondary-dark text-sm font-normal leading-normal max-w-md"
              >
                Please check your inbox for a confirmation email. If you don't
                see it, be sure to check your spam folder.
              </p>
            </div>
          </div>
        </main>
</x-layouts.guest>