<template>
  <div class="container flex flex-col w-full max-w-6xl pt-16 pb-32 mx-auto">
    <!-- <div class="w-full mx-auto my-10 text-center lg:my-24">
      <h1
        class="-mb-10 font-bold uppercase lg:hidden text-8xl opacity-5"
        style="font: normal normal 900 40px/60px Poppins"
      >
        Leistungen
      </h1>
      <h1
        class="hidden -mb-24 font-bold uppercase lg:block text-8xl opacity-5"
        style="font: normal normal 900 103px/129px Poppins"
      >
        Leistungen
      </h1>

      <h1 class="text-2xl lg:text-6xl">Unsere Services</h1>
    </div> -->
    <div class="flex flex-col w-full lg:flex-row">
      <div class="relative hidden lg:block lg:w-1/2 xl:w-1/3">
        <img
          src="/images/common/services/banner-image.jpg"
          alt=""
          height="100%"
          width="100%"
        />
        <!-- <div class="absolute p-5 lg:bottom-40 xl:bottom-10">
          <h1 class="text-2xl text-center text-white">Our Services</h1>
          <p class="mb-10 text-center text-white opacity-50">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text.
          </p>
        </div> -->
      </div>
      <div class="w-full lg:w-2/3">
        <div class="flex flex-col w-full lg:flex-row lg:mb-16">
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/cosmetics-icon.png"
              class="w-12 mx-auto lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Kosmetik
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Perfektes Make Up, Kosmetikbehandlungen und vieles mehr für die
              Schönheit.
            </p>
            <a
              href="/businesses?branch=3"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/hairdressing-icon.png"
              class="w-12 mx-auto lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Hairstyling
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Traumhaft schöne Haare zu jedem Anlass von erfahrenen
              Hairstylisten.
            </p>
            <a
              href="/businesses?branch=1"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
        </div>
        <div class="flex flex-col w-full lg:flex-row lg:mb-16">
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/nail-icon.png"
              class="w-10 mx-auto lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Nagelstudios
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Schöne Nägel und individuelle Nagelmodellagen in deinem
              Nagelstudio.
            </p>
            <a
              href="/businesses?branch=3"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
          <div class="relative mb-10 lg:hidden">
            <img
              src="/images/common/services/banner-image.jpg"
              alt=""
              style="position: center center"
              class="hidden object-cover lg:block h-96"
              width="100%"
            />
            <div
              class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 lg:hidden"
            ></div>
            <img
              src="/images/common/services/services-banner-mobile.png"
              alt=""
              style="position: center center"
              class="object-cover lg:hidden h-96"
              width="100%"
            />
            <div class="absolute p-5 bottom-10">
              <h1 class="text-2xl text-center text-white">Our Services</h1>
              <p class="mb-10 text-center text-white opacity-50">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text.
              </p>
            </div>
          </div>
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/piercing-icon.png"
              class="mx-auto w-9 lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Piercings
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Termine für perfekte Piercings und Körperschmuck im richtigen
              Studio vereinbaren.
            </p>
            <a
              href="/businesses?branch=2"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
        </div>
        <div class="flex flex-col w-full lg:flex-row lg:mb-16">
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/massage-icon.png"
              class="w-12 mx-auto lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Massage Salons
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Ein gesunder Körper und ein glücklicher Geist dank professioneller
              Massagen.
            </p>
            <a
              href="/businesses?branch=4"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
          <div class="flex flex-col w-full px-10 mb-10 lg:w-1/2 lg:mb-0">
            <img
              src="/images/common/services/tattoo-icon.png"
              class="w-12 mx-auto lg:ml-0"
            />
            <h1
              class="mt-3 text-xl font-medium text-center text-black lg:text-2xl lg:text-left"
            >
              Tattoos
            </h1>
            <p class="mt-3 mb-5 text-sm text-center lg:text-left">
              Schönheit für die Ewigkeit jetzt beim richtigen Tätowierer buchen.
            </p>
            <a
              href="/businesses?branch=2"
              class="px-6 py-3 mx-auto text-sm font-medium text-center text-white rounded-full w-52 lg:ml-0 lg:text-md custom-button bg-secondary-400 hover:border-primary-400"
              >Termin vereinbaren
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>