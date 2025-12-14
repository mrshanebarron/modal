import Modal from './Modal.vue';

export { Modal };

export default {
  install(app) {
    app.component('LdModal', Modal);
  }
};
