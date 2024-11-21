// Define categories
const categories = [
  {
    name: 'Smart ICT',
    color: 'blue',
    symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
        </svg>`,
  },
  {
    name: 'IoT Applications',
    color: 'purple',
    symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>`,
  },
  {
    name: 'Data Science & Analytics',
    color: 'blue',
    symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>`,
  },
  {
    name: 'Business Management',
    color: 'purple',
    symbol: `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>`,
  },
];

// Load timeline data from local storage or use default
function loadTimelineData() {
  const saved = localStorage.getItem('roadmapData');
  if (saved) {
    return JSON.parse(saved);
  }
  localStorage.setItem('roadmapData', JSON.stringify(defaultTimelineData));
  return defaultTimelineData;
}

// Save timeline data to local storage
function saveTimelineData(data) {
  localStorage.setItem('roadmapData', JSON.stringify(data));
  window.dispatchEvent(new Event('roadmapUpdate'));
}

// Default timeline data
const defaultTimelineData = [
  {
    period: '2018-2022',
    items: {
      'Smart ICT': [
        'Network management System',
        'Network Topology',
        'Concept/Electronics and IT Embedded System',
      ],
      'IoT Applications': ['IoT systems', 'Sensors for IoT'],
      'Data Science & Analytics': [
        'Decision Support System',
        'Classification System',
        'Prediction System',
        'Cluster Analysis',
      ],
      'Business Management': [
        'Digital Marketing',
        'Micro Commerce Management',
        'Digital Tax Management',
      ],
    },
  },
  {
    period: '2022-2025',
    items: {
      'Smart ICT': [
        'LORA Systems',
        'LORA mesh for IT Systems',
        'LORA for Smart Systems',
      ],
      'IoT Applications': [
        'IoT for urban farming',
        'IoT for freshwater fish',
        'Smart Home',
        'IoT for Power Electric Distribution',
      ],
      'Data Science & Analytics': [
        'Big Data Analysis',
        'Natural Language Processing',
        'Image Processing',
      ],
      'Business Management': [
        'Governance Fiscal Independence',
        'Commercial Port Management System',
        'Document Archiving Management',
      ],
    },
  },
  {
    period: '2026-2028',
    items: {
      'Smart ICT': [
        'ICT for Industrial Automation',
        'Integrated Data Transaction',
      ],
      'IoT Applications': [
        'Smart City',
        'Smart Ecosystem',
        'Smart monitoring Systems',
      ],
      'Data Science & Analytics': [
        'Voice Command Technology',
        'Land & Building Mapping',
        'Intelligence System',
        'Integrated Information System',
      ],
      'Business Management': [
        'Customer Relation Management System',
        'Supply Chain Management',
        'Analytic of Documents Archiving',
      ],
    },
  },
];

// Initialize data
let timelineData = loadTimelineData();