<?php

namespace singleton;

use dotty\Dotty;

/**
 * Globals are bad because they are not unit testable.
 * But they are convenient for runtime invariants
 * like database connections.
 *
 * Extend from GlobalSingleton rarely when you MUST have indelable singletons
 *
 * I know Singleton could extend from GlobalSingleton, but I wanted this behavior for a reason
 */
abstract class GlobalSingleton extends Singleton {

	public static function clearInstance($name = null) {
		throw new \RuntimeException('not allowed to clear global singletons');
	}

	public static function clearAllInstances() {
		throw new \RuntimeException('not allowed to clear global singletons');
	}
}

