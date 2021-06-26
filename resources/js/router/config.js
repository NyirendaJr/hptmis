export const protectedRoute = [
  {
    path: '/dashboard',
    name: 'dashboard',
    meta: {
      title: 'dashboard',
      icon: 'mdi-view-dashboard',
    },
  },
  //calendar
  {
    path: '/calendar',
    meta: {
      title: 'calendar',
      icon: 'mdi-calendar-check',
    },
    name: 'calendar',
  },
  //calendar
  {
    path: '/kanboard',
    meta: {
      title: 'kanboard',
      icon: 'mdi-drag-variant',
    },
    name: 'kanboard',
  },
  {
    path: '/chat',
    meta: {
      title: 'chat',
      icon: 'mdi-chat',
      isNew: true,
    },
    redirect: '/chat/messaging',
  },
  {
    path: '/media',
    meta: {
      title: 'media',
      icon: 'mdi-image',
      isNew: true,
    },
    redirect: '/media/file',
  },

  //element
  {
    path: '/element',
    meta: {
      title: 'element',
      icon: 'mdi-dots-square',
    },
    redirect: '/element/cascader',
    children: [
      {
        path: '/element/cascader',
        name: 'element.cascader',
        meta: {
          title: 'cascader',
          icon: 'mdi-alpha-c',
        },
      },
    ],
  },
  //task
  {
    path: '/task',
    redirect: '/task/list',
    meta: {
      title: 'task',
      icon: 'mdi-grid',
    },
    children: [
      {
        path: '/task/list',
        name: 'task',
        meta: {
          title: 'task',
          icon: 'mdi-newspaper',
        },
        redirect: '/task/list',
      },
    ],
  },
  //widgets
  {
    path: '/widgets',
    meta: {
      title: 'widget',
      icon: 'mdi-widgets',
    },
    redirect: '/widgets/social',
    children: [
      {
        path: '/widgets/social',
        name: 'widgets.social',
        meta: {
          title: 'social',
          icon: 'mdi-face-profile',
        },
      },
      {
        path: '/widgets/statistic',
        name: 'widgets.statistic',
        meta: {
          title: 'statistic',
          icon: 'mdi-hexagon',
        },
      },
    ],
  },
  //form
  {
    path: '/forms',
    meta: {
      title: 'form',
      icon: 'mdi-form-textbox',
    },
    redirect: '/forms/basic',
    children: [
      {
        path: '/forms/basic',
        name: 'forms.basic',
        meta: {
          title: 'basic_form',
          icon: 'mdi-alpha-b',
        },
      },
      {
        path: '/forms/stepper',
        name: 'forms.stepper',
        meta: {
          title: 'step_form',
          icon: 'mdi-alpha-s',
        },
      },
    ],
  },
  //chart
  {
    path: '/chart',
    meta: {
      title: 'chart',
      icon: 'mdi-chart-line',
    },
    redirect: '/chart/echart',
    children: [
      {
        path: '/chart/echart',
        name: 'echart',
        meta: {
          title: 'echart',
          icon: 'mdi-paw',
        },
      },
      {
        path: '/chart/g2',
        name: 'g2',
        meta: {
          title: 'g2',
          icon: 'mdi-alpha-g',
        },
      },
    ],
  },

  {
    path: '/changelog',
    name: 'changelog',
    meta: {
      title: 'changelog',
      icon: 'mdi-timeline-text',
    },
  },
  {
    path: '/403',
    name: 'Forbidden',
    meta: {
      title: 'access_denied',
      hidden: true,
    },
  },
]
