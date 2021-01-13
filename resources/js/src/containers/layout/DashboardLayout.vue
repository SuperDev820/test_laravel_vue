<template>
  <div
    class="wrapper"
    :class="[
      { 'nav-open': $sidebar.showSidebar },
      { rtl: meta.rtlActive },
    ]"
  >
    <notifications></notifications>
    <side-bar
      :active-color="sidebarBackground"
      :background-image="sidebarBackgroundImage"
      :data-background-color="sidebarBackgroundColor"
    >
      <user-menu></user-menu>
      <mobile-menu></mobile-menu>
      <template slot="links">
        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'لوحة القيادةة',
            icon: 'dashboard',
            path: '/dashboard',
          }"
        />
        <sidebar-item
          v-else
          :link="{ name: 'Dashboard', icon: 'dashboard', path: '/dashboard' }"
        />

        <sidebar-item opened :link="{ name: 'Examples (API)', image: image }">
          <sidebar-item
            :link="{ name: 'User Profile', path: '/examples/user-profile' }"
          />
          <sidebar-item
            :link="{
              name: 'User Management',
              path: '/examples/user-management/list-users',
            }"
          />
        </sidebar-item>

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'الجداول',
            icon: 'content_paste',
            path: '/components/table',
          }"
        />
        <sidebar-item
          :link="{
            name: 'Table Lists',
            icon: 'content_paste',
            path: '/components/table',
          }"
        />

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'طباعة',
            icon: 'library_books',
            path: '/components/typography',
          }"
        />
        <sidebar-item
          v-else
          :link="{
            name: 'Typography',
            icon: 'library_books',
            path: '/components/typography',
          }"
        />

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'الرموز',
            icon: 'bubble_chart',
            path: '/components/icons',
          }"
        />
        <sidebar-item
          v-else
          :link="{
            name: 'Icons',
            icon: 'bubble_chart',
            path: '/components/icons',
          }"
        />

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'خرائط جوجل',
            icon: 'place',
            path: '/components/maps',
          }"
        />
        <sidebar-item
          v-else
          :link="{ name: 'Maps', icon: 'place', path: '/components/maps' }"
        />

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{
            name: 'إخطارات',
            icon: 'notifications',
            path: '/components/notifications',
          }"
        />
        <sidebar-item
          v-else
          :link="{
            name: 'Notifications',
            icon: 'notifications',
            path: '/components/notifications',
          }"
        />

        <sidebar-item
          v-if="meta.rtlActive"
          :link="{ name: 'دعم رتل', icon: 'language', path: '/components/rtl' }"
        />
        <sidebar-item
          v-else
          :link="{
            name: 'RTL Support',
            icon: 'language',
            path: '/components/rtl',
          }"
        />

        <li class="button-container">
          <div class="">
            <md-button
              class="md-block md-danger"
              target="_blank"
              >Upgrade to PRO
            </md-button>
          </div>
        </li>
      </template>
    </side-bar>

    <div class="main-panel">
      <top-navbar :pageName="pageName"></top-navbar>

      <fixed-plugin
        :color.sync="sidebarBackground"
        :colorBg.sync="sidebarBackgroundColor"
        :sidebarMini.sync="sidebarMini"
        :sidebarImg.sync="sidebarImg"
        :image.sync="sidebarBackgroundImage"
      >
      </fixed-plugin>

      <div :class="{ content: !meta.hideContent }">
        <div v-if="pageName == 'dashboard'">
          <zoom-center-transition :duration="200" mode="out-in">
            <!-- your content here -->
            <!-- <dashboard></dashboard> -->
          </zoom-center-transition>
        </div>
      </div>
      <content-footer v-if="!meta.hideFooter"></content-footer>
    </div>
  </div>
</template>
<script>
/* eslint-disable no-new */
import PerfectScrollbar from "perfect-scrollbar";
import "perfect-scrollbar/css/perfect-scrollbar.css";

function hasElement(className) {
  return document.getElementsByClassName(className).length > 0;
}

function initScrollbar(className) {
  if (hasElement(className)) {
    new PerfectScrollbar(`.${className}`);
    document.getElementsByClassName(className)[0].scrollTop = 0;
  } else {
    // try to init it later in case this component is loaded async
    setTimeout(() => {
      initScrollbar(className);
    }, 10);
  }
}

function reinitScrollbar() {
  let docClasses = document.body.classList;
  let isWindows = navigator.platform.startsWith("Win");
  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    initScrollbar("sidebar");
    initScrollbar("sidebar-wrapper");
    initScrollbar("main-panel");

    docClasses.add("perfect-scrollbar-on");
  } else {
    docClasses.add("perfect-scrollbar-off");
  }
}

import TopNavbar from "./include/TopNavbar.vue";
import ContentFooter from "./include/ContentFooter.vue";
import MobileMenu from "./include/Extra/MobileMenu.vue";
import FixedPlugin from "./include/FixedPlugin.vue";
import UserMenu from "./include/Extra/UserMenu.vue";
import Dashboard from "../sub/Dashboard.vue";

export default {
  components: {
    TopNavbar,
    ContentFooter,
    FixedPlugin,
    MobileMenu,
    UserMenu,
  },
  props: {
    pageName: String
  },
  data() {
    return {
      meta: {
        rtlActive: false,
        hideContent: false,
        hideFooter: false
      },
      sidebarBackgroundColor: "black",
      sidebarBackground: "green",
      sidebarBackgroundImage: process.env.VUE_APP_APP_BASE_URL + "/img/sidebar-2.jpg",
      sidebarMini: false,
      sidebarImg: false,
      image: process.env.VUE_APP_APP_BASE_URL + "/img/laravel-vue.svg",
    };
  },
  methods: {
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    minimizeSidebar() {
      if (this.$sidebar) {
        this.$sidebar.toggleMinimize();
      }
    },
  },
  updated() {
    reinitScrollbar();
  },
  mounted() {
    reinitScrollbar();
  },
  watch: {
    sidebarMini() {
      this.minimizeSidebar();
    },
  },
};
</script>
<style lang="scss">
$scaleSize: 0.95;
@keyframes zoomIn95 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  to {
    opacity: 1;
  }
}
.main-panel .zoomIn {
  animation-name: zoomIn95;
}
@keyframes zoomOut95 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
}
.main-panel .zoomOut {
  animation-name: zoomOut95;
}
</style>
