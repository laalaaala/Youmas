require("./bootstrap.js");

/**
 * Import Vue
 */
import Vue from "vue/dist/vue";

/**
 * Vue Calendar
 */
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
Vue.use(VueCal);

/**
 * Vue Form Wizard
 */
import VueFormWizard from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
Vue.use(VueFormWizard);

/**
 * Vue Carousel
 */
import VueCarousel from "vue-carousel";
Vue.use(VueCarousel);

/**
 * Vue Google Autocomplete
 */
import x5GMaps from "x5-gmaps";
Vue.use(x5GMaps, {
    key: "AIzaSyClHoIH1cHvphRKUtAdrCtoLOMdzYN2eMo",
    libraries: ["places"]
});

/**
 * Vue Google Maps
 */
import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyClHoIH1cHvphRKUtAdrCtoLOMdzYN2eMo",
        libraries: "places"
    }
});

/**
 * Vue V-Calendar
 */
import VCalendar from "v-calendar";
Vue.use(VCalendar, {
    componentPrefix: "vc" // Use <vc-calendar /> instead of <v-calendar />
});

/**
 * Vue Axios
 */
Vue.use(require("vue-axios"), axios);

/**
 * Vue Confirm Dialog
 */
import VueConfirmDialog from "vue-confirm-dialog";
Vue.use(VueConfirmDialog);
Vue.component("vue-confirm-dialog", VueConfirmDialog.default);

/**
 * Vue Dropzone
 */
Vue.use(require("vue2-dropzone"));

/**
 * Vue Modaltor
 */
import VueModalTor from "vue-modaltor/dist/vue-modaltor.common";
import "vue-modaltor/dist/vue-modaltor.css";
Vue.use(VueModalTor);

/**
 * Vue Apex Charts
 */
import VueApexCharts from "vue-apexcharts";
Vue.use(VueApexCharts);
Vue.component("apexchart", VueApexCharts);

/**
 * Moment.js
 */
Vue.use(require("vue-moment"));

/**
 * Common
 */
import PageHeader from "./components/common/PageHeader.vue";
import How from "./components/common/How.vue";
import About from "./components/common/About.vue";
import Icons from "./components/common/Icons.vue";
import Team from "./components/common/Team.vue";
import RegisterCarousel from "./components/common/Welcome/RegisterCarousel.vue";
import ServicesCarousel from "./components/common/Welcome/ServicesCarousel.vue";
import Services from "./components/common/Services.vue";

/**
 * Admin Components
 */
import AdminProfile from "./components/admin/profile/AdminProfile.vue";
import AdminUserTable from "./components/admin/user/AdminUserTable.vue";
import AdminFaqsTable from "./components/admin/faqs/AdminFAQSTable.vue";
import AdminTransactionsTable from "./components/admin/transactions/AdminTransactionsTable.vue";
import AdminStatsContainer from "./components/admin/stats/AdminStatsContainer.vue";

/**
 * User Components
 */

// Business Views
import BusinessSingleView from "./components/user/business/single/BusinessSingleView.vue";
import BusinessListContainer from "./components/user/business/list/BusinessListContainer.vue";
import BusinessRating from "./components/user/business/common/BusinessRating.vue";
import BusinessSingleViewRating from "./components/user/business/single/BusinessSingleViewRating.vue";

// Business Dashboard
import BusinessProfile from "./components/user/business/profile/BusinessProfile.vue";
import BusinessProfileOpeningHours from "./components/user/business/profile/BusinessProfileOpeningHours.vue";
import BusinessProfileImageCarousel from "./components/user/business/profile/BusinessProfileImageCarousel.vue";
import BusinessStatistics from "./components/user/business/statistics/BusinessStatistics.vue";
import BusinessSubscription from "./components/user/business/subscriptions/BusinessSubscription.vue";
import BusinessSubscriptionDetail from "./components/user/business/subscriptions/BusinessSubscriptionDetail.vue";
import BusinessPlanningCalendar from "./components/user/business/calendars/BusinessPlanningCalendar.vue";
import BusinessBookingCalendar from "./components/user/business/calendars/BusinessBookingCalendar.vue";
import BusinessServiceTable from "./components/user/business/services/BusinessServiceTable.vue";
import BusinessSimpleFilter from "./components/user/business/common/BusinessSimpleFilter.vue";
import BusinessEmployeeTable from "./components/user/business/employee/BusinessEmployeeTable.vue";
import CustomerBusinessReview from "./components/user/customer/CustomerBusinessReview.vue";

import BusinessRegisterView from "./components/user/business/registration/BusinessRegisterView.vue";

// User - Customer
import CustomerRegisterView from "./components/user/customer/registration/CustomerRegisterView.vue";
import CustomerBookingCalendar from "./components/user/customer/CustomerBookingCalendar.vue";
import CustomerBookingTable from "./components/user/customer/CustomerBookingTable.vue";
import CustomerProfile from "./components/user/customer/CustomerProfile.vue";
import CustomerCheckout from "./components/user/customer/checkout/CustomerCheckout.vue";
import CustomerFavorites from "./components/user/customer/CustomerFavorites.vue";

// User - Common
import UserChangePasswordModal from "./components/user/common/UserChangePasswordModal.vue";

/**
 * Public Components
 */
import FaqsView from "./components/FaqsView.vue";
import PricingTable from "./components/PricingTable.vue";

const app = new Vue({
    el: "#app",
    components: {
        PageHeader,
        How,
        About,
        Icons,
        Team,
        Services,
        RegisterCarousel,
        ServicesCarousel,
        AdminUserTable,
        AdminFaqsTable,
        BusinessSingleView,
        BusinessListContainer,
        BusinessRating,
        BusinessSingleViewRating,
        BusinessProfileImageCarousel,
        BusinessSimpleFilter,
        BusinessPlanningCalendar,
        BusinessBookingCalendar,
        BusinessEmployeeTable,
        CustomerCheckout,
        CustomerBookingTable,
        CustomerProfile,
        CustomerRegisterView,
        CustomerBookingCalendar,
        CustomerBusinessReview,
        CustomerFavorites,
        BusinessServiceTable,
        BusinessRegisterView,
        BusinessProfile,
        AdminProfile,
        UserChangePasswordModal,
        AdminTransactionsTable,
        FaqsView,
        BusinessProfileOpeningHours,
        BusinessSubscription,
        PricingTable,
        AdminStatsContainer,
        BusinessStatistics,
        BusinessSubscriptionDetail
    }
});
