import { createRouter, createWebHistory } from "vue-router"
import { useAuth } from "./stores/auth"

const routes = [
  {
    path: "/",
    name: "landing",
    component: () => import("./pages/Landing.vue"),
  },
  {
    path: "/signin",
    name: "signin",
    component: () => import("./pages/SignIn.vue"),
  },
  {
    path: "/signup",
    name: "signup",
    component: () => import("./pages/SignUp.vue"),
  },
  {
    path: "/board/:id",
    name: "board",
    component: () => import("./pages/KanbanBoard.vue"),
    meta: { requiresAuth: true },
  },
]

const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHistory(),
  routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
  const auth = useAuth()

  if (to.meta.requiresAuth && !auth.isAuth) {
    next({ name: "signin" })
  } else next()
})

export default router
