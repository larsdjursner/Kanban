import { defineStore } from "pinia"

import boardsData from "../mockdata/boards.json"

export const useStore = defineStore("main", {
  state: () => ({
    boards: [],
    currentBoard: null,
  }),

  getters: {
    getBoards: (state) => state.boards,

    getCurrentBoard: (state) => state.currentBoard,
  },

  actions: {
    fetchBoards() {
      this.boards = boardsData
    },

    setCurrentBoard(id) {
      if (typeof id !== Number) {
        id = parseInt(id, 10)
      }
      // fetch
      this.currentBoard = this.boards.find((board) => board.id === id)
    },
  },
})
