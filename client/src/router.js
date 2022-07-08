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
    path: "/boards",
    name: "boards",
    component: () => import("./pages/DefaultBoard.vue"),
    meta: { requiresAuth: true },
  },
  {
    path: "/boards/:id",
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

router.beforeEach(async (to, from, next) => {
  const auth = useAuth()

  if (!auth.isAuth) {
    const tokenExists = await auth.checkForToken()
    !tokenExists && next({ name: "landing" })
  }

  if (to.meta.requiresAuth && !auth.isAuth) {
    next({ name: "signin" })
  } else next()

  if (auth.isAuth && (to.name === "signup" || to.name === "signin")) {
    next({ name: "boards" })
  }
})

export default router
