import Index from 'pages/Index'
import Login from "pages/Login";
import MainLayout from "layouts/MainLayout";
import Rubro from "pages/Rubro";
import Producto from "pages/Producto";
import Venta from "layouts/Venta";
import Pedido from "pages/Pedido";
const routes = [
  // {path: '/',component: Venta},
  {
    path: '/',
    component: Venta,
    children: [
      { path: '', component: Index },
      { path: '/login', component: Login },
      { path: '/rubro', component: Rubro,meta: {requiresAuth: true,}},
      { path: '/producto', component: Producto ,meta: {requiresAuth: true,}},
      { path: '/pedido', component: Pedido ,meta: {requiresAuth: true,}},
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
