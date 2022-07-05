import { createRouter, createWebHistory } from "vue-router"

const routes = [
  {
    path: "/",
    redirect: {
      name: "board",
    },
  },
  {
    path: "/board/:id",
    name: "board",
    component: () => import("./pages/KanbanBoard.vue"),
  },
]

const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHistory(),
  routes, // short for `routes: routes`
})

export default router