import styles from './sample.scss';

// console.log('Component SampleComponent loaded');

class SampleComponent extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });

    // Get data
    const innerText  = this?.querySelector('.selector a')?.innerText;
    const link  = this?.querySelector('.selector a')?.href;
    const img = this?.querySelector('.selector img')?.outerHTML;
    const textContent = this?.querySelector('.selector')?.textContent.trim();
    const optionalText = this?.querySelector('.selector ul')?.outerHTML ?? '';

    // console.log(innerText);
    // console.log(link);
    // console.log(img);
    // console.log(textContent);
    // console.log(optionalText);

    const layout =`
      <div class="wrapper">
        ${img}
        <h2>${textContent}</h2>
        <p class='optional'>${optionalText}</p>
        <a class='subhead' href="${link}>${innerText}</a>
      </div>
    `;

    const styleSheet = new CSSStyleSheet();
    styleSheet.replaceSync(styles);
    this.shadowRoot.adoptedStyleSheets = [styleSheet];

    this.shadowRoot.innerHTML = layout;
  }
}

customElements.define('component-sample-component', SampleComponent);
