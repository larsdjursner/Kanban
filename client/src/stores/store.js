import { defineStore } from "pinia"

import boardsData from "../mockdata/boards.json"

export const useStore = defineStore("main", {
  state: () => ({
    boards: boardsData,
  }),

  getters: {
    getBoards: (state) => state.boards,
  },

  actions: {},
})
