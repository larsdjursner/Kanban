<template>
  <div
    class="w-screen h-screen max-h-screen max-w-screen bg-white flex flex-col md:px-40 px-20 pb-10 relative z-0"
  >
    <span
      class="bg-slate-100/80 absolute w-full h-[20rem] hidden md:block left-0 bottom-0 z-10"
    ></span>
    <div class="h-20 min-h-20 w-full flex justify-between items-center">
      <p class="font-bold text-2xl">Kanban</p>
    </div>
    <span class="w-full border-b"></span>

    <!-- content area -->
    <div
      class="h-full w-full flex md:flex-row flex-col gap-10 justify-between pt-10 z-20"
    >
      <div class="flex flex-col md:w-1/2 gap-10">
        <div class="flex flex-col">
          <div class="flex justify-start gap-4">
            <p class="text-5xl leading-relaxed">Your</p>

            <p
              class="bg-indigo-700 my-2 ml-2 px-12 rounded-md transform rotate-[4deg] text-4xl text-white leading-relaxed"
            >
              Tasking
            </p>
          </div>
          <p class="text-5xl leading-relaxed">
            experience just took a turn buddy
          </p>
        </div>

        <p class="text-xl">
          Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod.
        </p>

        <!-- action -->
        <div class="flex justify-between h-1/2 w-full gap-8">
          <div
            class="border-2 rounded-lg h-full w-full border-indigo-400 p-4 flex flex-col justify-between"
          >
            <p class="text-lg">Lorem ipsum dolor sit amet.</p>
            <p class="text-sm">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed.
            </p>

            <TextButton class="w-full mx-0 bg-indigo-400 hover:bg-indigo-600">
              <router-link to="/signup">
                <p class="text-white">{{ "Sign up" }}</p>
              </router-link>
            </TextButton>
          </div>
          <div
            class="border-2 rounded-lg h-full w-full border-pink-400 p-4 flex flex-col justify-between"
          >
            <p class="text-lg">Lorem ipsum dolor sit amet.</p>
            <p class="text-sm">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed.
            </p>
            <TextButton class="w-full mx-0 bg-pink-400 hover:bg-pink-600">
              <router-link to="/signin">
                <p class="text-white">{{ "Sign in" }}</p>
              </router-link>
            </TextButton>
          </div>
        </div>
      </div>
      <div class="flex flex-col w-1/2">
        <!-- image -->
        <div class="w-full h-3/5 bg-indigo-200 rounded-md overflow-hidden">
          <img
            :src="currentImg"
            alt="nice lil img"
            class="object-cover h-full w-full"
          />
        </div>
        <!-- <img src="https://unsplash.com/photos/r1V-OtZR7XY" alt="yo" /> -->

        <div
          class="border-2 rounded-lg border-slate-400/20 flex flex-col p-4 mt-20"
        >
          <p class="text-lg">
            Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod
          </p>

          <p class="text-sm">
            Quis aute iure reprehenderit in voluptate velit esse cillum dolore
            eu fugiat nulla pariatur. Ex laborum.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    images: [],
  }),

  computed: {
    currentImg() {
      return new URL(this.images[0], import.meta.url).href
    },
  },

  created() {
    const images = import.meta.globEager("@/assets/*.jpg")

    this.images = Object.keys(images)
  },
}
</script>
