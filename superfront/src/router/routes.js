import Index from 'pages/Index';
import Login from "pages/Login";
import MainLayout from "layouts/MainLayout";
import Rubro from "pages/Rubro";
import Producto from "pages/Producto";
import Venta from "layouts/Venta";
import Pedido2 from "pages/Pedido2";
import Mipedido from "pages/Mipedido";
import Pedido3 from "pages/Pedido3";
import Pedido4 from "pages/Pedido4";
import Pedido5 from "pages/Pedido5";
import Pedidosrealizados from "pages/Pedidosrealizados";
import Producto2 from "pages/Producto2";
import Usuario from "pages/Usuario";
const routes = [
  // {path: '/',component: Venta},
  {
    path: '/',
    component: Venta,
    children: [
      { path: '', component: Index },
      { path: '/login', component: Login },
      { path: '/rubro', component: Rubro,meta: {requiresAuth: true,}},
      { path: '/producto', component: Producto2 ,meta: {requiresAuth: true,}},
      { path: '/venta', component: Pedido2 ,meta: {requiresAuth: true,}},
      { path: '/venta2', component: Pedido3 ,meta: {requiresAuth: true,}},
      { path: '/venta3', component: Pedido4 ,meta: {requiresAuth: true,}},
      { path: '/venta4', component: Pedido5 ,meta: {requiresAuth: true,}},
      { path: '/mipedido', component: Mipedido ,meta: {requiresAuth: true,}},
      { path: '/pedidosrealizados', component: Pedidosrealizados ,meta: {requiresAuth: true,}},
      { path: '/usuario', component: Usuario ,meta: {requiresAuth: true,}},
      // { path: '/pedido/:id/:nombre', component: Pedido ,meta: {requiresAuth: true,}},
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
