<template>
	<BoardModal
		:showModal="showModal"
		:editing="editing"
		@closeModal="closeModal"
		@navigateToBoard="board => navigateToBoard(board)"
	/>

	<div class="h-screen w-screen max-h-screen max-w-screen flex flex-col">
		<Navbar />

		<SidebarDrawer>
			<template #header>
				<div class="w-full flex justify-center border-y py-2">
					<p class="text-sm">
						{{ `All boards ( ${store.getBoardAmount} )` }}
					</p>
				</div>
			</template>
			<template #content>
				<ul
					v-if="store.getBoards"
					ref="list"
					class="h-full overflow-y-auto scrollbar flex flex-col rounded-md shadow-lg"
				>
					<BoardListItem
						v-for="board in store.getBoards"
						:key="`board-${board.id}`"
						:ref="`board-${board.id}`"
						:board="board"
					/>
				</ul>
			</template>
			<template #buttons>
				<NewBoard @showModal="showCreateModal" />
			</template>

			<template #bodyOptions>
				<button class="h-6 w-6" @click="edit">
					<CogIcon class="h-full w-full hover:text-slate-500" @click="showEditModal" />
				</button>
			</template>

			<template #title>
				<p class="text-xl">{{ currentBoardName }}</p>
			</template>

			<template #body>
				<BoardContent :id="parseInt($route.params.id)" />
			</template>
		</SidebarDrawer>
	</div>
</template>

<script>
import { useStore } from "../../stores/store"
import { animate, stagger } from "motion"

import SidebarDrawer from "../../components/menu/SidebarDrawer.vue"
import Navbar from "../../components/Navbar.vue"

import NewBoard from "../../components/NewBoard.vue"
import BoardModal from "./BoardModal.vue"

import BoardContent from "./BoardContent.vue"
import BoardListItem from "./BoardListItem.vue"
import AddStory from "./partials/AddStory.vue"

import { CogIcon } from "@heroicons/vue/outline"

export default {
	components: {
		BoardListItem,
		Navbar,
		BoardModal,
		NewBoard,
		BoardContent,
		AddStory,
		SidebarDrawer,
		CogIcon,
	},

	data: () => ({
		store: useStore(),
		showModal: false,
		editing: false,
	}),

	computed: {
		currentId() {
			return this.$route.params.id
		},
	},

	watch: {
		currentId() {
			this.fetchBoard()
		},
	},

	created() {
		this.fetchBoard()
		this.fetchBoards()
	},

	mounted() {
		this.appendAnimations()
		// this.scrollToBoard(this.$route.params.id)
	},

	methods: {
		fetchBoards() {
			this.$http.get("/boards").then(({ data }) => {
				this.store.setBoards(data)
			})
		},

		fetchBoard(id = this.$route.params.id) {
			this.$http.get(`/boards/${id}`).then(({ data }) => {
				this.store.setCurrentBoard(data)
			})
		},

		navigateToBoard(id) {
			this.$router.replace({ name: "board", params: { id } })
		},

		appendAnimations() {
			const { list } = this.$refs

			animate(list.children, { opacity: [0, 1] }, { delay: stagger(0.1, { start: 0.3 }) })
		},

		scrollToBoard() {},

		showEditModal() {
			this.showModal = true
			this.editing = true
		},

		showCreateModal() {
			this.showModal = true
		},

		closeModal() {
			this.showModal = false
			this.editing = false
		},
	},
}
</script>
