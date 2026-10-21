Yes. You can keep the customer on the checkout page by showing the 3‑D Secure challenge in an iframe or modal iframe. CyberSource’s Payer Authentication flow supports posting the step-up JWT to the returned stepUpUrl inside an iframe; after the challenge, the issuer returns the customer to your configured returnUrl within that iframe. Payer Authentication

A typical flow is:
1. Your backend checks the saved card’s 3DS enrollment.
2. If a challenge is required, your frontend displays the step-up page in an iframe.
3. The iframe returns to your returnUrl; that page can notify the checkout page with postMessage or let it check your backend.
4. Your backend calls CyberSource’s authentication validation service, then proceeds with authorization as appropriate. Payer Authentication
So you can avoid opening a separate browser window, but you still need a way to detect that the challenge finished and trigger server-side validation. Don’t treat a browser callback alone as proof of successful authentication; use the CyberSource validation response. Some issuers or browser conditions may prevent an embedded challenge, so keep a redirect or new-window fallback. CyberSource documents challenge sizes up to full screen, and recommends sizing the iframe to the challenge requested. Payer Authentication

If by “validate endpoint” you mean a particular endpoint in your own integration, share the endpoint/API flow you’re using and I can map this to your exact sequence.
