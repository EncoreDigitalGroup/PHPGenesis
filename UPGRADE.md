# PHPGenesis Version 4 Upgrade Guide

### Changes

- IDisposable has been moved from `PHPGenesis\Common\Interfaces\IDisposable` to `PHPGenesis\Laravel\Disposable\Interfaces\IDisposable`.
- The corresponding events in `PHPGenesis\Common\Events` have been moved to `PHPGenesis\Laravel\Disposable\Events`.
- The corresponding event listeners in `PHPGenesis\Common\Events\Listeners` have been moved to `PHPGenesis\Laravel\Disposable\Events\Listeners`.
- All items in `PHPGenesis\Common\Laravel` have been moved to `PHPGenesis\Laravel`.
- All items in `PHPGenesis\Common\Resources\Rector` have been moved to `PHPGenesis\DevUtilities\Rector\Rules`.
- `PHPGenesis\Laravel\Traits\HasExternalId` has been moved to `PHPGenesis\Laravel\Traits\HasExternalId`.