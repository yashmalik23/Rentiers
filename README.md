Goal
Keep the customer on the current checkout page during payment and any 3-D Secure challenge. Do not navigate the top-level page to a CyberSource URL or open a new tab/window for step-up authentication.

Please inspect the existing code and implement this in the project’s current framework and coding style.

1. Identify the current payment flow
- Find the checkout UI, saved-card handling, CyberSource API calls, and any code that redirects to a 3DS URL or listens for a `3ds-callback`.
- Identify whether we use Unified Checkout, Flex/Microform, TMS tokens, or a custom Payer Authentication flow.
- Check the CyberSource SDK/API version and existing backend endpoints before changing anything.
- Do not expose CyberSource REST credentials or signing keys in frontend code.

2. Prefer Unified Checkout’s embedded flow if compatible
- If this integration uses Unified Checkout and the saved-card/token setup is supported, have the backend create the CyberSource session/capture context.
- Set `targetOrigins` to the exact HTTPS origin of our checkout application.
- Configure the complete mandate with the existing payment operation (`AUTH` or `CAPTURE`, as appropriate) and `consumerAuthentication: "3DS"`. Keep the existing TMS/saved-card configuration where compatible.
- In the frontend, initialize `VAS.UnifiedCheckout(sessionJWT)` and mount checkout in embedded mode inside the current checkout page.
- Use the SDK’s documented completion result/promise to update the UI. Do not add a top-level redirect or manually open the step-up URL.
- Let Unified Checkout handle its Payer Authentication calls when this configuration supports the selected saved-card method.

3. Verify saved-card compatibility before implementing
- Determine the exact token type used by our saved cards and confirm that the selected Unified Checkout flow accepts it.
- Do not assume that the Flex `/tokens` endpoint is a checkout or 3DS endpoint. It tokenizes encrypted card data; CyberSource says it is not designed for browser use. Use the project’s existing supported Microform or Unified Checkout flow as applicable.
- If our current saved-card tokens cannot be used with Unified Checkout, stop and report the specific incompatibility and the required CyberSource-supported alternative. Do not silently replace or migrate stored tokens.

4. If we must keep a custom Payer Authentication flow
- Keep the checkout route loaded and display the step-up challenge in an iframe/modal iframe using the CyberSource-provided `stepUpUrl` and JWT as a form POST, following CyberSource’s Payer Authentication documentation.
- Set the challenge return URL to a publicly reachable HTTPS endpoint on our domain. It must not resolve to localhost, a private IP, or an internal hostname.
- Have that endpoint receive the challenge result and notify the parent checkout page using a narrowly scoped, origin-checked `postMessage`, or let the frontend query our backend.
- Have the backend perform CyberSource authentication validation and authorization. Never treat a frontend message alone as proof of successful authentication.
- Do not try to read or manipulate CyberSource’s cross-origin iframe contents.

5. Add robust status and error handling
- Show loading, challenge-required, success, failure, cancellation, and timeout states without unloading the checkout page.
- Prevent duplicate authorization if the callback/message is received more than once.
- Verify the final payment status with our backend/CyberSource response.
- Log useful errors without logging PAN, CVV, secrets, or full payment tokens.

6. Verify the implementation
- Test frictionless authentication, a challenge-required transaction, authentication failure/cancellation, and callback timeout.
- Confirm the checkout page does not navigate or open another window during 3DS.
- Check Chrome DevTools for Local Network Access, CORS, iframe, or blocked-navigation errors.
- Report which flow was implemented, the files changed, required CyberSource configuration, and any saved-token compatibility issue. Do not invent unsupported SDK methods; use the project’s installed SDK version and CyberSource’s documentation.
