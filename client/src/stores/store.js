import { defineStore } from "pinia"

// useStore could be anything like useUser, useCart
// the first argument is a unique id of the store across your application
export const useStore = defineStore("main", {
    state: () => ({
        // all these properties will have their type inferred automatically
        counter: 0,
        name: "Eduardo",
        isAdmin: true,
    }),

    getters: {
        getCount(state) {
            return state.counter
        },

        getCountTimesTwo: (state) => state.counter * 2
    },

    actions: {
        increment() {
            this.counter++
        },
        randomizeCounter() {
            this.counter = Math.round(100 * Math.random())
        },
    },
})
