import { createRouter, createWebHistory } from "vue-router"

const routes = [
  {
    path: "/",
    redirect: {
      name: "kanban",
    },
  },
  {
    path: "/kanban",
    name: "kanban",
    component: () => import("./pages/KanbanBoard.vue"),
  },
  {
    path: "/test",
    name: "test",
    component: () => import("./pages/Testpage.vue"),
  },
]

const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHistory(),
  routes, // short for `routes: routes`
})

export default router
