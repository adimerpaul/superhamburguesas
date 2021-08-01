import Index from 'pages/Index'
import Login from "pages/Login";
import MainLayout from "layouts/MainLayout";
import Rubro from "pages/Rubro";
import Producto from "pages/Producto";
import Venta from "layouts/Venta";
const routes = [
  {path: '/',component: Venta},
  {
    path: '/menu',
    component: MainLayout,
    children: [
      { path: '', component: Index },
      { path: '/login', component: Login },
      { path: '/rubro', component: Rubro },
      { path: '/producto', component: Producto },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
