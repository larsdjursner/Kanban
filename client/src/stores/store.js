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

    getFirstBoard: (state) => {
      if (state.boards.length > 0) {
        return state.boards[0]
      }

      return null
    },
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

    updateBoard(id, board) {
      this.boards = this.boards.map((_board) => {
        if (_board.id === id) {
          _board = { ...board }
        }
      })
    },

    deleteBoardById(id) {
      this.boards = this.boards.filter((board) => board.id !== id)
    },
  },
})
