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
          Quasar App
        </q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          Essential Links
        </q-item-label>

        <q-item
          clickable
          to="/menu"
          exact
        >
          <q-item-section
            avatar
          >
            <q-icon name="home" />
          </q-item-section>

          <q-item-section>
            <q-item-label>Home</q-item-label>
            <q-item-label caption>
              Ingreso al sistema
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-item
          v-if="!$store.getters.isLoggedIn"
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
          to="/cliente"
          exact
          v-if="$store.state.boolcontribuyente"
        >
          <q-item-section
            avatar
          >
            <q-icon name="person" />
          </q-item-section>

          <q-item-section>
            <q-item-label>Contribuyente</q-item-label>
            <q-item-label caption>
              Datos Contribuyente
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-item
          v-if="$store.getters.isLoggedIn"
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
      </q-list>
    </q-drawer>

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

export default defineComponent({
  name: 'MainLayout',

  components: {
    // EssentialLink
  },

  setup () {
    const $store = useStore()
    const $q = useQuasar()
    const $router = useRouter()
    const leftDrawerOpen = ref(false)

    return {
      // essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
      logout () {
        $q.loading.show()
        $store.dispatch('logout')
          .then(() => {
            $q.loading.hide()
            $router.push('/login')
          })
      }
    }
  }
})
</script>
