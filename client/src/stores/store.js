import { defineStore } from "pinia"

export const useStore = defineStore("main", {
  state: () => ({
    boards: [],
    currentBoard: null,
  }),

  getters: {
    getBoards: (state) => state.boards,

    getBoardAmount: (state) => state.boards.length,

    getCurrentBoard: (state) => state.currentBoard,
  },

  actions: {
    setBoards(boards) {
      this.boards = boards
    },

    setCurrentBoard(board) {
      this.currentBoard = board
    },

    addBoard(board) {
      this.boards = [...this.boards, board]
    },
  },
})
