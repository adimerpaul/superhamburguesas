<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
<!--          Quasar App-->
        </q-toolbar-title>

        <div>Pedidos {{ 0 }}</div>
      </q-toolbar>
      <div class="q-px-lg q-pt-xs q-mb-md">
        <div class="text-h5 text-bold">Super Hamburguesas</div>
        <div class="text-subtitle1">{{ now }}</div>
      </div>
      <q-img src="img/super.jpg" class="header-image absolute-top" />
    </q-header>
    <q-drawer
          v-model="leftDrawerOpen"
          show-if-above
          :width="250"
          :breakpoint="600"
    >
      <q-scroll-area style="height: calc(100% - 130px); margin-top: 130px; border-right: 1px solid #ddd">
        <q-list padding>
          <q-item
            clickable
            exact
            to="/"
          >
            <q-item-section
              avatar
            >
              <q-icon name="home" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Principal</q-item-label>
              <q-item-label caption>
                Pagina principal
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item
            v-if="!$store.getters['showcase/isLoggedIn']"
            clickable
            exact
            to="/login"
          >
            <q-item-section
              avatar
            >
              <q-icon name="login" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Login</q-item-label>
              <q-item-label caption>
                Ingreso al sistema
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item
            clickable
            exact
            to="rubro"

          >
            <q-item-section
              avatar
            >
              <q-icon name="send" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Rubro</q-item-label>
              <q-item-label caption>
                Administrar rubros
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item
            clickable
            exact
            to="producto"
            v-if="$store.getters['showcase/isLoggedIn']"
          >
            <q-item-section
              avatar
            >
              <q-icon name="category" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Producto</q-item-label>
              <q-item-label caption>
                Administrar productos
              </q-item-label>
            </q-item-section>
          </q-item>
 
                         <div v-for="agencias in agen" :key="agencias">
          <q-item
            v-if="$store.getters['showcase/isLoggedIn']"
            clickable
            exact
            to="pedido"
            @click="pedidoagencia(agencias)"
             >
            <q-item-section
              avatar >
              <q-icon name="shopping_cart" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Pedido {{agencias.nombre}}</q-item-label>
              <q-item-label caption>
                Productos para la venta.
              </q-item-label>
            </q-item-section>
          </q-item>
          </div>

          <q-item
            v-if="$store.getters['showcase/isLoggedIn']"
            clickable
            @click="logout"
          >
            <q-item-section
              avatar
            >
              <q-icon name="logout" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Salir</q-item-label>
              <q-item-label caption>
                Salir del sistema
              </q-item-label>
            </q-item-section>
          </q-item>

<!--          <q-item clickable v-ripple>-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="inbox" />-->
<!--            </q-item-section>-->

<!--            <q-item-section>-->
<!--              Inbox-->
<!--            </q-item-section>-->
<!--          </q-item>-->

<!--          <q-item active clickable v-ripple>-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="star" />-->
<!--            </q-item-section>-->

<!--            <q-item-section>-->
<!--              Star-->
<!--            </q-item-section>-->
<!--          </q-item>-->

<!--          <q-item clickable v-ripple>-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="send" />-->
<!--            </q-item-section>-->

<!--            <q-item-section>-->
<!--              Send-->
<!--            </q-item-section>-->
<!--          </q-item>-->

<!--          <q-item clickable v-ripple>-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="drafts" />-->
<!--            </q-item-section>-->

<!--            <q-item-section>-->
<!--              Drafts-->
<!--            </q-item-section>-->
<!--          </q-item>-->
        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="img/super.jpg" style="height: 130px">
        <div class="absolute-bottom bg-transparent ">
<!--          <q-avatar size="56px" class="q-mb-sm">-->
<!--            <img src="https://cdn.quasar.dev/img/boy-avatar.png">-->
<!--          </q-avatar>-->
          <div class="text-weight-bold">Super Hamburguesas </div>
          <div>Menu</div>
        </div>
      </q-img>
    </q-drawer>
<!--    <q-drawer-->
<!--      v-model="leftDrawerOpen"-->
<!--      show-if-above-->
<!--      bordered-->
<!--      class="bg-grey-1"-->
<!--    >-->
<!--      <q-list>-->
<!--        <q-item-label-->
<!--          header-->
<!--          class="text-grey-8"-->
<!--        >-->
<!--          Essential Links-->
<!--        </q-item-label>-->

<!--        <q-item-->
<!--          clickable-->
<!--          to="/menu"-->
<!--          exact-->
<!--        >-->
<!--          <q-item-section-->
<!--            avatar-->
<!--          >-->
<!--            <q-icon name="home" />-->
<!--          </q-item-section>-->

<!--          <q-item-section>-->
<!--            <q-item-label>Home</q-item-label>-->
<!--            <q-item-label caption>-->
<!--              Ingreso al sistema-->
<!--            </q-item-label>-->
<!--          </q-item-section>-->
<!--        </q-item>-->
<!--        <q-item-->
<!--          v-if="!$store.getters.isLoggedIn"-->
<!--          clickable-->
<!--          exact-->
<!--          to="/login"-->
<!--        >-->
<!--          <q-item-section-->
<!--            avatar-->
<!--          >-->
<!--            <q-icon name="login" />-->
<!--          </q-item-section>-->

<!--          <q-item-section>-->
<!--            <q-item-label>Login</q-item-label>-->
<!--            <q-item-label caption>-->
<!--              Ingreso al sistema-->
<!--            </q-item-label>-->
<!--          </q-item-section>-->
<!--        </q-item>-->

<!--        <q-item-->
<!--          clickable-->
<!--          to="/cliente"-->
<!--          exact-->
<!--          v-if="$store.state.boolcontribuyente"-->
<!--        >-->
<!--          <q-item-section-->
<!--            avatar-->
<!--          >-->
<!--            <q-icon name="person" />-->
<!--          </q-item-section>-->

<!--          <q-item-section>-->
<!--            <q-item-label>Contribuyente</q-item-label>-->
<!--            <q-item-label caption>-->
<!--              Datos Contribuyente-->
<!--            </q-item-label>-->
<!--          </q-item-section>-->
<!--        </q-item>-->
<!--        <q-item-->
<!--          v-if="$store.getters.isLoggedIn"-->
<!--          clickable-->
<!--          @click="logout"-->
<!--        >-->
<!--          <q-item-section-->
<!--            avatar-->
<!--          >-->
<!--            <q-icon name="logout" />-->
<!--          </q-item-section>-->

<!--          <q-item-section>-->
<!--            <q-item-label>Salir</q-item-label>-->
<!--            <q-item-label caption>-->
<!--              Salir del sistema-->
<!--            </q-item-label>-->
<!--          </q-item-section>-->
<!--        </q-item>-->
<!--      </q-list>-->
<!--    </q-drawer>-->

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { useQuasar } from 'quasar'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import {date} from 'quasar'

export default defineComponent({
  name: 'Venta',
  components: {
    // EssentialLink
  },
  data(){
    return{
        $store : useStore(),
        $q : useQuasar(),
        $router : useRouter(),
        //$agencia:0,
        agen:[],
        leftDrawerOpen : false,
        // timeStamp : Date.now(),
        now :date.formatDate(Date.now(), 'dddd D  MMMM', {
          days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado' /* and all the rest of days - remember starting with Sunday */],
          daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
          months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre' /* and all the rest of months */],
          monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
        })
    }
  },
  created() {
    // console.log(this.$store)
    this.agencia();
  },
  methods:{
        toggleLeftDrawer () {
          this.leftDrawerOpen = !this.leftDrawerOpen
        },
        logout () {
          this.$q.loading.show()
          this.$store.dispatch('showcase/logout')
            .then(() => {
              this.$q.loading.hide()
              this.$router.push('/login')
            })
        },
      agencia(){
        this.$axios.get(process.env.API+'/agencia').then(res=>{
          console.log(res.data);
          this.agen=res.data;
        })

      },
      pedidoagencia(agencia){
        console.log(agencia);
        //this.$store.dispatch('showcase/menu',agencia);
        this.$q.localStorage.remove('menuagencia');
        this.$q.localStorage.set('menuagencia',agencia);
        console.log(this.$q.localStorage.getItem('menuagencia'));
        //this.$router.go();

        //this.store.state.menuagencia=agencia;
      
      }
  }

  // setup () {
  //   const $store = useStore()
  //   const $q = useQuasar()
  //   const $router = useRouter()
  //   const leftDrawerOpen = ref(false)
  //   const timeStamp = Date.now()
  //   const now =date.formatDate(timeStamp, 'dddd D  MMMM', {
  //     days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado' /* and all the rest of days - remember starting with Sunday */],
  //     daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
  //     months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre' /* and all the rest of months */],
  //     monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
  //   })
  //   return {
  //     // essentialLinks: linksList,
  //     now,
  //     leftDrawerOpen,
  //     toggleLeftDrawer () {
  //       leftDrawerOpen.value = !leftDrawerOpen.value
  //     },
  //     logout () {
  //       $q.loading.show()
  //       $store.dispatch('logout')
  //         .then(() => {
  //           $q.loading.hide()
  //           $router.push('/login')
  //         })
  //     }
  //   }
  // }
})
</script>
<style lang="scss">
.header-image{
  height: 100%;
  z-index: -1;
  opacity: 0.2;
  filter: grayscale(100%);
}
</style>
