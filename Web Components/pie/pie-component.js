class PieComponent extends HTMLElement {

  id = (Math.random() + 1).toString(36).substring(2);

  chart_type;
  chart_max;
  chart_val;
  chart_remainder;
  color = 'aqua';
  spacer = 'white';

  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
  }

  connectedCallback() {
    this.render();

    new Chart(
      this.shadowRoot.getElementById(this.id),
      {
        type: 'doughnut',
        legend: false,
        data: {
          //  labels: ["HTML", 'None'],
           datasets: [{
           data: [this.chart_val, this.chart_remainder],
           backgroundColor: [this.color, this.spacer],
           }],
        },
        options: {
          events: []
        },
     });
  }

  render() {
    this.setColor(this.attributes?.color?.value ?? this.color);
    this.setBGColor(this.attributes?.spacer?.value ?? this.spacer);
    this.setType(this.attributes.type.value);
    this.setMax(this.attributes.max.value);
    this.setVal(this.attributes.val.value);
    this.setRemainder(this.chart_max - this.chart_val);

    const layout = `<crust style='display: block; height: 50px; width: 50px;'><p>${this.chart_val}<canvas id=${this.id}></canvas></crust>`;

    this.shadowRoot.innerHTML = layout;
  }

  setColor($a) { this.color = $a; }
  setBGColor($a) { this.spacer = $a; }
  setId($a) { this.id = $a; }
  setType($a) { this.chart_type = $a; }
  setMax($a) { this.chart_max = $a; }
  setVal($a) { this.chart_val = $a; }
  setRemainder($a) { this.chart_remainder = $a; }
}

customElements.define('pie-component', PieComponent);