<template>
  <div class="flex flex-wrap justify-start w-full gap-y-2 lg:gap-y-5">
    <div
      class="w-full lg:pb-5 lg:w-1/3"
      v-for="favorite in favorites"
      :key="favorite.id"
    >
      <div class="flex flex-row mx-2 border-2 border-gray-300 lg:flex-col">
        <div
          class="items-center justify-center hidden w-full h-64 pb-3 overflow-hidden border-b border-gray-300 lg:flex"
        >
          <a
            class="object-cover object-center lg:h-full"
            :href="'/businesses/' + favorite.id"
          >
            <img
              v-if="favorite.pictures.length"
              class="object-cover object-center lg:h-full"
              :src="favorite.pictures[0].link"
              alt=""
            />
          </a>
        </div>
        <div
          class="flex items-center w-1/3 overflow-hidden border-r-2 border-gray-300 md:h-52 lg:hidden"
        >
         <a
            class="object-cover object-center h-full"
            :href="'/businesses/' + favorite.id"
          >
          <img
            v-if="favorite.pictures.length"
            class="object-cover object-center h-full"
            :src="favorite.pictures[0].link"
            alt=""
          />
         </a>
        </div>
        <div class="flex flex-col w-2/3 lg:w-full">
          <a :href="'/businesses/' + favorite.id">
            <h1
              class="px-3 mt-3 text-xl font-bold lg:text-2xl text-secondary-500"
            >
              {{ favorite.name }}
            </h1>
          </a>
          <div
            class="flex flex-wrap px-3 my-3 text-sm text-gray-500 lg:my-5 lg:text-md"
          >
            <span
              class="flex mr-1"
              v-for="(service, index) in favorite.services"
              :key="service.id"
            >
              {{ service.sub_category.name }}
              <span v-if="index + 1 < favorite.services.length">,</span>
            </span>
          </div>
          <span
            class="flex flex-row items-center w-full px-3 mb-3 text-sm text-gray-500 lg:text-md"
          >
            <i class="mr-2 fas fa-map-marker-alt"></i>
            {{ favorite.user.location.formatted_address }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    favorites: {
      type: Array,
      required: true,
    },
  },
};
</script>