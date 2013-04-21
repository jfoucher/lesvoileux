# use cap deploy CAP_ENV=preprod|prod

set :target,      ENV['CAP_ENV'] || "prod"
default_run_options[:pty] = true
set   :use_sudo,      false

set :deploy_via, :remote_cache
set :app_path,    "app"
set :web_path,    "web"
#set  :dump_assetic_assets, true

set :langs, ['en', 'fr', 'de', 'es']

if "preprod" == target
  set :user, "ubuntu"
  set :clear_controllers, false
  set :domain,      "dev.#{application}.com"
  set :branch,  "develop"
  set :symfony_env_prod,  "dev"
  set :symfony_debug_prod, ""
  set :deploy_to,   "/home/ubuntu/www/lesvoileux.com"
elsif "prod" == target
  set :user, "ubuntu"
  set :domain,  "lesvoileux.com"
  set :branch,      "develop"
  set :symfony_env_prod,  "prod"
  set :symfony_debug_prod, "--no-debug"
  set :deploy_to,   "/home/ubuntu/www/lesvoileux.com"
else
  raise "unknown target '#{target}'"
end

set :repository,  "git@bitbucket.org:jfoucher/lesvoileux.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor", "app/Resources/translations", "uploads"]
set :shared_files,      ["app/config/parameters.yml"]

#langs.each do |lang|
#  shared_files.push "app/Resources/translations/messages.#{lang}.xliff"
#  shared_files.push "app/Resources/translations/validators.#{lang}.xliff"
#end

after "symfony:cache:warmup" do

  run "cd #{latest_release} && #{php_bin} #{symfony_console} --env=#{symfony_env_prod} #{symfony_debug_prod} assetic:dump"

  langs.each do |lang|
    run "cd #{latest_release} && #{php_bin} #{symfony_console} --env=#{symfony_env_prod} #{symfony_debug_prod} translation:extract --config app #{lang}"
  end
end
before "symfony:cache:warmup" do

  #run "cd #{latest_release} && #{php_bin} #{symfony_console} --env=#{symfony_env_prod} #{symfony_debug_prod} doctrine:schema:update --force"

end


set :use_composer, true
set :update_vendors, true

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

namespace :deploy do
  desc "Overwrite the restart task because symfony doesn't need it."
  task :restart do
    #run "sudo /etc/init.d/php5-fpm reload"
  end

  desc "Overwrite the stop task because symfony doesn't need it."
  task :stop do ; end
end